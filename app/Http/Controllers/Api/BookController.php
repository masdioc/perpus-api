<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Book;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/books",
     *     summary="Ambil semua data buku",
     *     tags={"Books"},
     *     @OA\Response(
     *         response=200,
     *         description="Sukses"
     *     )
     * )
     */
    // public function index()
    // {
    //     return response()->json([
    //         'message' => 'List of books'
    //     ]);
    // }
    public function index()
    {
        return Book::with('category')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required',
            'stock' => 'required|integer|min:0'
        ]);

        return Book::create($validated);
    }

    public function show($id)
    {
        return Book::with('category')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    public function destroy($id)
    {
        return Book::destroy($id);
    }
}
