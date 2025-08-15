<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/api/documentation', function () {
    return view('vendor.l5-swagger.index');
});
// Route::get('/', fn() => redirect()->route('home'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('index');
// Route::get('/', function () {
//     $books = [
//         [
//             'title' => 'Belajar Laravel 10',
//             'author' => 'Budi Santoso',
//             'cover' => 'https://via.placeholder.com/150x200?text=Laravel+10'
//         ],
//         [
//             'title' => 'Mastering Tailwind CSS',
//             'author' => 'Siti Aminah',
//             'cover' => 'https://via.placeholder.com/150x200?text=Tailwind+CSS'
//         ],
//         [
//             'title' => 'Dasar Pemrograman PHP',
//             'author' => 'Andi Wijaya',
//             'cover' => 'https://via.placeholder.com/150x200?text=PHP'
//         ],
//     ];
//     return view('home', ['title' => 'Home', 'books' => $books]);
// })->name('home');
