<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // # Tampilkan form checkout
    public function checkout()
    {
        $carts = Cart::with('book')->where('user_id', session('user_id'))->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $carts->sum(fn($c) => $c->book->price * $c->quantity);

        return view('user.checkout.index', compact('carts', 'total'));
    }

    // # Proses pembuatan pesanan (Payment at Delivery)
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'notes'            => 'nullable|string',
        ]);

        $carts = Cart::with('book')->where('user_id', session('user_id'))->get();

        if ($carts->isEmpty()) {
            return redirect()->route('user.cart')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $carts->sum(fn($c) => $c->book->price * $c->quantity);

        $order = Order::create([
            'user_id'          => session('user_id'),
            'order_code'       => 'ORD-' . strtoupper(Str::random(8)),
            'status'           => 'pending',
            'total_price'      => $total,
            'shipping_address' => $request->shipping_address,
            'payment_method'   => 'payment_at_delivery',
            'notes'            => $request->notes,
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id'  => $cart->book_id,
                'quantity' => $cart->quantity,
                'price'    => $cart->book->price,
            ]);

            // # Kurangi stok buku
            $cart->book->decrement('stock', $cart->quantity);
        }

        // # Kosongkan keranjang setelah order dibuat
        Cart::where('user_id', session('user_id'))->delete();

        return redirect()->route('user.orders.show', $order)->with('success', 'Pesanan berhasil dibuat! Pembayaran dilakukan saat buku tiba.');
    }

    // # Tampilkan daftar pesanan user
    public function index()
    {
        $orders = Order::where('user_id', session('user_id'))->latest()->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    // # Tampilkan detail pesanan dan status pengiriman
    public function show(Order $order)
    {
        if ($order->user_id !== session('user_id')) {
            abort(403);
        }

        $order->load('orderItems.book', 'shipping');

        return view('user.orders.show', compact('order'));
    }
}
