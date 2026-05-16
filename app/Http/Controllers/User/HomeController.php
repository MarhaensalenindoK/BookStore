<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    // # Tampilkan halaman beranda user dengan daftar buku
    public function index()
    {
        $query = Book::with('category')->where('stock', '>', 0);

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . request('search') . '%')
                  ->orWhere('author', 'like', '%' . request('search') . '%');
            });
        }

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        $books      = $query->latest()->paginate(12)->appends(request()->query());
        $categories = Category::all();

        return view('user.home', compact('books', 'categories'));
    }

    // # Tampilkan halaman About Us
    public function about()
    {
        return view('user.about');
    }
}
