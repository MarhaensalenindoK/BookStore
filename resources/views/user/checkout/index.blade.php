@extends('layouts.app')

@section('title', 'Checkout - Marhaensa Store')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Checkout - Payment at Delivery</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Form Checkout --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4">Informasi Pengiriman</h2>
            <form action="{{ route('user.checkout.store') }}" method="POST" class="space-y-4" id="checkoutForm">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman <span class="text-red-500">*</span></label>
                    <textarea name="shipping_address" rows="3" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                        placeholder="Alamat lengkap, RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos">{{ old('shipping_address', session('user_address')) }}</textarea>
                    @error('shipping_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                    <input type="text" name="notes" value="{{ old('notes') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                        placeholder="Catatan untuk kurir atau toko...">
                    @error('notes') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl">💳</span>
                        <div>
                            <p class="font-semibold text-orange-700 text-sm">Payment at Delivery</p>
                            <p class="text-orange-600 text-xs mt-1">
                                Pembayaran dilakukan secara tunai ketika buku tiba di alamat Anda.
                                Pastikan Anda memiliki uang tunai sejumlah total pesanan.
                            </p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full text-white py-3 rounded-xl font-semibold hover:opacity-90 transition text-sm"
                    style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                    ✅ Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>

    {{-- Ringkasan --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5 sticky top-24">
            <h2 class="font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h2>
            <div class="space-y-3 mb-4">
                @foreach($carts as $cart)
                <div class="flex gap-3 items-center">
                    <img src="{{ $cart->book->cover_image }}" class="w-10 h-13 object-cover rounded">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ $cart->book->title }}</p>
                        <p class="text-xs text-gray-500">x{{ $cart->quantity }}</p>
                    </div>
                    <p class="text-sm font-medium">Rp {{ number_format($cart->book->price * $cart->quantity, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>
            <div class="border-t pt-3 flex justify-between items-center">
                <span class="font-semibold">Total</span>
                <span class="text-xl font-bold text-purple-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <p class="text-xs text-gray-400 mt-3 text-center">Bayar tunai saat buku tiba</p>
        </div>
    </div>
</div>
@endsection
