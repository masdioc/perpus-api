<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        // Optional filter by status/user
        $query = Loan::with(['user:id,name,email', 'items.book:id,title'])
            ->when($request->status, fn($q) => $q->where('status', $request->status))
            ->when($request->user_id, fn($q) => $q->where('user_id', $request->user_id))
            ->latest();

        return $query->paginate(15);
    }

    public function show($id)
    {
        return Loan::with(['user:id,name,email', 'items.book'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:loan_date',
            'items' => 'required|array|min:1',
            'items.*.book_id' => 'required|exists:books,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        $loan = DB::transaction(function () use ($validated) {
            $loan = Loan::create([
                'user_id'     => $validated['user_id'],
                'loan_date'   => $validated['loan_date'],
                'return_date' => $validated['return_date'],
                'status'      => 'borrowed'
            ]);

            foreach ($validated['items'] as $item) {
                $book = Book::lockForUpdate()->find($item['book_id']); // lock stok
                if ($book->stock < $item['quantity']) {
                    throw new \Exception("Stok buku '{$book->title}' tidak cukup.");
                }

                $book->decrement('stock', $item['quantity']);

                LoanItem::create([
                    'loan_id'  => $loan->id,
                    'book_id'  => $item['book_id'],
                    'quantity' => $item['quantity']
                ]);
            }

            return $loan->load(['items.book']);
        });

        return response()->json([
            'message' => 'Peminjaman berhasil',
            'data' => $loan
        ], 201);
    }


    public function returnLoan(Request $request, $id)
    {
        $loan = Loan::with('items.book')->findOrFail($id);

        if ($loan->status === 'returned') {
            return response()->json(['message' => 'Pinjaman ini sudah dikembalikan.'], 422);
        }

        // tanggal pengembalian faktual
        $actualReturn = $request->input('actual_return')
            ? Carbon::parse($request->input('actual_return'))
            : Carbon::today();

        DB::transaction(function () use ($loan, $actualReturn) {
            // Kembalikan stok untuk setiap item
            foreach ($loan->items as $item) {
                $book = Book::lockForUpdate()->find($item->book_id);
                $book->increment('stock', $item->quantity);
            }

            // Hitung denda
            $finePerDay = (int) config('library.fine_per_day', 2000);
            $dueDate    = Carbon::parse($loan->return_date);

            $daysLate = max(0, $actualReturn->diffInDays($dueDate, false) * -1); // hari terlambat
            $totalBooks = $loan->totalBooks();
            $fine = $daysLate > 0 ? $daysLate * $finePerDay * $totalBooks : 0;

            $loan->update([
                'actual_return' => $actualReturn->toDateString(),
                'status'        => $daysLate > 0 ? 'late' : 'returned',
                'fine_amount'   => $fine
            ]);
        });

        return response()->json([
            'message' => 'Pengembalian berhasil diproses',
            'data' => $loan->fresh(['items.book'])
        ]);
    }
}
