<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    // # Tampilkan semua data pengiriman
    public function index()
    {
        $shippings = Shipping::with('order.user')->latest()->paginate(10);

        return view('admin.shipping.index', compact('shippings'));
    }

    // # Buat atau update data pengiriman untuk sebuah order
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'status'           => 'required|in:processing,shipped,delivered',
            'tracking_number'  => 'nullable|string|max:100',
            'estimated_date'   => 'nullable|date',
            'notes'            => 'nullable|string',
        ]);

        Shipping::updateOrCreate(
            ['order_id' => $order->id],
            $request->only(['status', 'tracking_number', 'estimated_date', 'notes'])
        );

        // # Sinkronkan status order dengan status pengiriman
        $orderStatus = match($request->status) {
            'processing' => 'confirmed',
            'shipped'    => 'shipped',
            'delivered'  => 'delivered',
        };

        $order->update(['status' => $orderStatus]);

        return back()->with('success', 'Data pengiriman berhasil disimpan.');
    }
}
