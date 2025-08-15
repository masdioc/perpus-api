<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
// use App\Mail\UserResetPassword;
use DB;

class UserController extends Controller
{
    // public function getUserById($id)
    // {
    //     $user = User::with('seller')->find($id);

    //     if (!$user) {
    //         return response()->json(['message' => 'User tidak ditemukan'], 404);
    //     }

    //     $data = [
    //         'id'    => $user->id,
    //         'name'  => $user->name,
    //         'email' => $user->email,
    //         'role'  => $user->role,
    //         'status'  => 'aktif',
    //     ];

    //     // Jika user adalah seller, tambahkan detail seller
    //     if ($user->role === 'seller' && $user->seller) {
    //         $data['seller'] = [
    //             'id'        => $user->seller->id,
    //             'nama_toko' => $user->seller->nama_toko,
    //             'no_no_hp'     => $user->seller->no_no_hp,
    //             'alamat'    => $user->seller->alamat,
    //         ];
    //     }

    //     return response()->json($data);
    // }
    public function index(Request $request)
    {
        $query = User::with('seller');

        if ($request->role) {
            $query->where('role', $request->role);
        }

        return $query->orderBy('id', 'desc')->paginate(10); // <= penting!
    }


    public function getUserById($id)
    {
        $user = DB::table('users')
            ->leftJoin('sellers', 'users.id', '=', 'sellers.user_id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.role',
                'sellers.id as seller_id',
                'sellers.nama_toko',
                'sellers.alamat',
                'sellers.no_hp'
            )
            ->where('users.id', $id)
            ->first();

        if (!$user || !in_array($user->role, ['buyer', 'seller', 'admin'])) {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'seller' => $user->role === 'seller' ? [
                'id' => $user->seller_id,
                'nama_toko' => $user->nama_toko,
                'alamat' => $user->alamat,
                'no_hp' => $user->no_hp,
            ] : null,
        ]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['buyer', 'seller'])) {
            return response()->json(['message' => 'User tidak bisa diubah'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'role' => 'in:buyer,seller',
        ]);

        $user->update($validated);

        return response()->json([
            'message' => 'User berhasil diupdate',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['buyer', 'seller'])) {
            return response()->json(['message' => 'User tidak bisa dihapus'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $user = User::findOrFail($id);

        // Optional: batasi hanya user dengan role buyer/seller yang bisa diubah statusnya
        if (!in_array($user->role, ['buyer', 'seller'])) {
            return response()->json(['message' => 'Status user tidak dapat diubah'], 403);
        }

        $user->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Status berhasil diperbarui',
            'user' => $user
        ]);
    }
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        if (!in_array($user->role, ['buyer', 'seller'])) {
            return response()->json(['message' => 'User tidak valid'], 403);
        }

        $newPassword = '12345678'; // bisa juga pakai Str::random(8)

        $user->password = Hash::make($newPassword);
        $user->save();

        // Kirim email ke user
        // Mail::to($user->email)->send(new UserResetPassword($user, $newPassword));

        // return response()->json([
        //     'message' => 'Password berhasil di-reset dan dikirim ke email user.'
        // ]);
        return response()->json([
            'message' => 'Password berhasil di-reset .'
        ]);
    }
}
