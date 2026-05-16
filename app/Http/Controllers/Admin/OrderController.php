<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // # Tampilkan semua pesanan dari user
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    // # Tampilkan detail pesanan
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.book', 'shipping');

        return view('admin.orders.show', compact('order'));
    }

    // # Update status pesanan
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,shipped,delivered,cancelled']);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
