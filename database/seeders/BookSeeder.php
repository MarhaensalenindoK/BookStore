<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    // # Seed data buku sample
    public function run(): void
    {
        $books = [
            // Novel (cat 1)
            ['category_id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2005, 'stock' => 20, 'price' => 85000, 'description' => 'Kisah inspiratif tentang semangat anak-anak Belitung dalam menggapai pendidikan.', 'cover_image' => 'https://picsum.photos/seed/book1/300/400'],
            ['category_id' => 1, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Lentera Dipantara', 'year' => 1980, 'stock' => 15, 'price' => 95000, 'description' => 'Novel sejarah yang menggambarkan perjuangan di era kolonial Belanda.', 'cover_image' => 'https://picsum.photos/seed/book2/300/400'],
            ['category_id' => 1, 'title' => 'Negeri 5 Menara', 'author' => 'Ahmad Fuadi', 'publisher' => 'Gramedia', 'year' => 2009, 'stock' => 18, 'price' => 79000, 'description' => 'Perjalanan hidup anak-anak muda dari pesantren yang menapaki dunia internasional.', 'cover_image' => 'https://picsum.photos/seed/book3/300/400'],
            ['category_id' => 1, 'title' => 'Perahu Kertas', 'author' => 'Dee Lestari', 'publisher' => 'Bentang Pustaka', 'year' => 2009, 'stock' => 12, 'price' => 72000, 'description' => 'Kisah cinta dua anak muda yang masing-masing mengejar mimpinya.', 'cover_image' => 'https://picsum.photos/seed/book4/300/400'],
        ];

        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}
