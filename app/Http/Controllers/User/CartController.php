<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // # Tampilkan isi keranjang user
    public function index()
    {
        $carts = Cart::with('book.category')
                     ->where('user_id', session('user_id'))
                     ->get();

        $total = $carts->sum(fn($c) => $c->book->price * $c->quantity);

        return view('user.cart.index', compact('carts', 'total'));
    }

    // # Tambah buku ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'book_id'  => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::findOrFail($request->book_id);

        if ($book->stock < $request->quantity) {
            return back()->with('error', 'Stok buku tidak mencukupi.');
        }

        $cart = Cart::where('user_id', session('user_id'))
                    ->where('book_id', $request->book_id)
                    ->first();

        if ($cart) {
            $cart->increment('quantity', $request->quantity);
        } else {
            Cart::create([
                'user_id'  => session('user_id'),
                'book_id'  => $request->book_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    // # Hapus item dari keranjang
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== session('user_id')) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
