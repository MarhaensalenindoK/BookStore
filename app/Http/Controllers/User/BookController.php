<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    // # Tampilkan detail buku
    public function show(Book $book)
    {
        $related = Book::where('category_id', $book->category_id)
                       ->where('id', '!=', $book->id)
                       ->take(4)
                       ->get();

        return view('user.books.show', compact('book', 'related'));
    }
}
