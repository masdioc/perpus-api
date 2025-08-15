<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();

        return view('home', [
            'title' => 'Home',
            'books' => $books
        ]);
    }
}
