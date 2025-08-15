@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded-xl shadow-lg">
        @auth
            <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name }} 👋</h2>
            <p class="text-gray-600 mb-8">Berikut adalah koleksi buku terbaru kami untuk Anda.</p>
        @endauth

        @guest
            <h2 class="text-2xl font-extrabold text-gray-800 mb-2">Selamat Datang di <span class="text-blue-600">Perpustakaan
                    Universitas Siliwangi</span></h2>
            <p class="text-gray-600 mb-8">Jelajahi koleksi buku kami. Login untuk mulai meminjam buku favorit Anda.</p>
        @endguest

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach ($books as $book)
                <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-lg transition">
                    <img src="{{ 'public/images/' . $book['cover_image'] ?? 'https://via.placeholder.com/300x200' }}"
                        alt="{{ $book['title'] }}" class="mx-auto max-w-[200px] max-h-[300px] w-auto h-auto object-contain">

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800">{{ $book['title'] }}</h3>
                        <p class="text-sm text-gray-600 mb-2">Penulis: {{ $book['author'] }}</p>
                        <p class="text-gray-700 text-sm">
                            {{ Str::limit($book['description'] ?? 'Tidak ada deskripsi', 80) }}
                        </p>
                    </div>

                    <div class="px-4 pb-4 flex space-x-2">
                        <a href="#"
                            class="flex-1 text-center px-2 py-1 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Lihat Detail
                        </a>
                        <a href="#"
                            class="flex-1 text-center px-2 py-1 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                            Pinjam
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
