@extends('layouts.app')

@section('title', 'Pesanan Saya - Marhaensa Store')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">📦 Pesanan Saya</h1>

@if($orders->isEmpty())
<div class="bg-white rounded-2xl shadow-sm p-16 text-center">
    <div class="text-6xl mb-4">📦</div>
    <h2 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan</h2>
    <p class="text-gray-500 text-sm mb-6">Yuk mulai belanja buku pertama Anda!</p>
    <a href="{{ route('user.home') }}" class="text-white px-8 py-3 rounded-xl font-medium hover:opacity-90 transition inline-block"
       style="background: linear-gradient(135deg, #462C7D, #D552A3)">
        Belanja Sekarang
    </a>
</div>
@else
<div class="space-y-4">
    @foreach($orders as $order)
    <div class="bg-white rounded-xl shadow-sm p-5">
        <div class="flex items-center justify-between mb-3">
            <div>
                <span class="font-mono text-sm text-purple-600 font-semibold">{{ $order->order_code }}</span>
                <span class="text-gray-400 text-xs ml-3">{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
            @php
                $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'confirmed' => 'bg-blue-100 text-blue-700', 'shipped' => 'bg-indigo-100 text-indigo-700', 'delivered' => 'bg-green-100 text-green-700', 'cancelled' => 'bg-red-100 text-red-700'];
            @endphp
            <span class="{{ $colors[$order->status] ?? 'bg-gray-100 text-gray-700' }} text-xs px-3 py-1 rounded-full font-medium">
                {{ ucfirst($order->status) }}
            </span>
        </div>
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Pembayaran</p>
                <p class="font-bold text-purple-700 text-lg">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="text-xs text-orange-500 mt-1">💳 Payment at Delivery</p>
            </div>
            <a href="{{ route('user.orders.show', $order) }}"
               class="text-white px-5 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition"
               style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                Lihat Detail
            </a>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6">{{ $orders->links() }}</div>
@endif
@endsection
