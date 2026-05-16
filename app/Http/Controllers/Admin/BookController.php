<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // # Tampilkan daftar semua buku
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    // # Form tambah buku baru
    public function create()
    {
        $categories = Category::all();

        return view('admin.books.create', compact('categories'));
    }

    // # Simpan buku baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:200',
            'author'       => 'required|string|max:100',
            'publisher'    => 'nullable|string|max:100',
            'year'         => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock'        => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|string|max:500',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // # Form edit data buku
    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    // # Simpan perubahan data buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:200',
            'author'       => 'required|string|max:100',
            'publisher'    => 'nullable|string|max:100',
            'year'         => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock'        => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'description'  => 'nullable|string',
            'cover_image'  => 'nullable|string|max:500',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    // # Hapus buku dari database
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function show(Book $book) {}
}
