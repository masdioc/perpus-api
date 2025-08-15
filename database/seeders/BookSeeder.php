<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'category_id' => 1,
                'title' => 'Pemrograman Laravel untuk Pemula',
                'author' => 'Budi Santoso',
                'publisher' => 'Informatika',
                'year' => 2023,
                'isbn' => '978-602-1234-56-1',
                'stock' => 5,
                'description' => 'Panduan lengkap mempelajari Laravel dari dasar hingga mahir.',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Laravel'
            ],
            [
                'category_id' => 2,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'year' => 2005,
                'isbn' => '978-979-3062-79-3',
                'stock' => 3,
                'description' => 'Kisah inspiratif anak-anak Belitong dalam mengejar pendidikan.',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Laskar+Pelangi'
            ],
            [
                'category_id' => 3,
                'title' => 'Sejarah Peradaban Dunia',
                'author' => 'Dr. Slamet Widodo',
                'publisher' => 'Erlangga',
                'year' => 2020,
                'isbn' => '978-602-3456-78-9',
                'stock' => 4,
                'description' => 'Buku referensi sejarah peradaban manusia dari zaman kuno hingga modern.',
                'cover_image' => 'https://via.placeholder.com/200x300?text=Sejarah'
            ]
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
