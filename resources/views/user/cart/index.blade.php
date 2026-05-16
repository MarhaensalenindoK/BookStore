@extends('layouts.app')

@section('title', 'Keranjang Belanja - Marhaensa Store')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">🛒 Keranjang Belanja</h1>

@if($carts->isEmpty())
<div class="bg-white rounded-2xl shadow-sm p-16 text-center">
    <div class="text-6xl mb-4">🛒</div>
    <h2 class="text-xl font-semibold text-gray-700 mb-2">Keranjang Kosong</h2>
    <p class="text-gray-500 text-sm mb-6">Belum ada buku yang ditambahkan ke keranjang.</p>
    <a href="{{ route('user.home') }}" class="text-white px-8 py-3 rounded-xl font-medium hover:opacity-90 transition inline-block"
       style="background: linear-gradient(135deg, #462C7D, #D552A3)">
        Jelajahi Buku
    </a>
</div>
@else
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-4">
        @foreach($carts as $cart)
        <div class="bg-white rounded-xl shadow-sm p-4 flex gap-4 items-center">
            <img src="{{ $cart->book->cover_image }}" alt="{{ $cart->book->title }}"
                 class="w-16 h-20 object-cover rounded-lg shadow-sm flex-shrink-0">
            <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $cart->book->title }}</h3>
                <p class="text-xs text-gray-500">{{ $cart->book->author }}</p>
                <p class="text-xs text-pink-500 mt-1">{{ $cart->book->category->name }}</p>
                <div class="flex items-center gap-4 mt-2">
                    <span class="font-bold text-purple-700">Rp {{ number_format($cart->book->price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 text-sm">x{{ $cart->quantity }}</span>
                    <span class="font-semibold text-gray-800">= Rp {{ number_format($cart->book->price * $cart->quantity, 0, ',', '.') }}</span>
                </div>
            </div>
            <form action="{{ route('user.cart.destroy', $cart) }}" method="POST"
                  onsubmit="return confirm('Hapus buku ini dari keranjang?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-600 transition p-2">
                    🗑️
                </button>
            </form>
        </div>
        @endforeach
    </div>

    {{-- Ringkasan Order --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5 sticky top-24">
            <h2 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-2 text-sm mb-4">
                @foreach($carts as $cart)
                <div class="flex justify-between text-gray-600">
                    <span class="truncate max-w-32">{{ $cart->book->title }}</span>
                    <span>Rp {{ number_format($cart->book->price * $cart->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            <div class="border-t border-gray-200 pt-3 flex justify-between items-center mb-5">
                <span class="font-semibold text-gray-700">Total</span>
                <span class="text-xl font-bold text-purple-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <div class="bg-orange-50 border border-orange-200 text-orange-700 text-xs px-3 py-2 rounded-lg mb-4">
                💳 Pembayaran dilakukan saat buku tiba (Payment at Delivery)
            </div>
            <a href="{{ route('user.checkout') }}" class="block text-center text-white py-3 rounded-xl font-medium hover:opacity-90 transition"
               style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                Lanjut ke Checkout →
            </a>
        </div>
    </div>
</div>
@endif
@endsection
