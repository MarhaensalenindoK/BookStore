@extends('layouts.app')

@section('title', 'Detail Pesanan - Marhaensa Store')

@section('content')
<div class="mb-6 flex items-center gap-3">
    <a href="{{ route('user.orders.index') }}" class="text-purple-600 hover:underline text-sm">← Pesanan Saya</a>
    <span class="text-gray-300">/</span>
    <span class="font-mono text-sm text-gray-600">{{ $order->order_code }}</span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Status Pengiriman --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <h2 class="font-semibold text-gray-800 mb-5">🚚 Status Pengiriman</h2>
            <div class="flex items-center gap-0">
                @php
                    $steps = ['pending' => 'Pesanan Dibuat', 'confirmed' => 'Dikonfirmasi', 'shipped' => 'Dalam Pengiriman', 'delivered' => 'Selesai'];
                    $statusOrder = ['pending', 'confirmed', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $statusOrder);
                    if ($order->status === 'cancelled') $currentIndex = -1;
                @endphp

                @foreach($steps as $key => $label)
                @php $stepIndex = array_search($key, $statusOrder); @endphp
                <div class="flex-1 flex flex-col items-center relative">
                    @if(!$loop->last)
                    <div class="absolute top-4 left-1/2 w-full h-1 {{ $stepIndex < $currentIndex ? '' : 'bg-gray-200' }}"
                         style="{{ $stepIndex < $currentIndex ? 'background: linear-gradient(to right, #D552A3, #FF70BF)' : '' }}"></div>
                    @endif
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold z-10 relative
                        {{ $stepIndex <= $currentIndex ? 'text-white' : 'bg-gray-200 text-gray-400' }}"
                        style="{{ $stepIndex <= $currentIndex ? 'background: linear-gradient(135deg, #462C7D, #D552A3)' : '' }}">
                        {{ $stepIndex < $currentIndex ? '✓' : $stepIndex + 1 }}
                    </div>
                    <p class="text-xs text-center mt-2 {{ $stepIndex <= $currentIndex ? 'text-purple-700 font-semibold' : 'text-gray-400' }}">{{ $label }}</p>
                </div>
                @endforeach

                @if($order->status === 'cancelled')
                <div class="flex-1 flex flex-col items-center">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold bg-red-500 text-white z-10">✕</div>
                    <p class="text-xs text-red-500 font-semibold mt-2">Dibatalkan</p>
                </div>
                @endif
            </div>

            @if($order->shipping)
            <div class="mt-6 bg-gray-50 rounded-lg p-4 grid grid-cols-3 gap-4 text-sm">
                <div>
                    <p class="text-gray-500 text-xs">Nomor Resi</p>
                    <p class="font-mono font-semibold">{{ $order->shipping->tracking_number ?? 'Belum ada' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Estimasi Tiba</p>
                    <p class="font-semibold">{{ $order->shipping->estimated_date ? $order->shipping->estimated_date->format('d M Y') : 'Belum ditentukan' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-xs">Catatan Pengiriman</p>
                    <p class="text-gray-700">{{ $order->shipping->notes ?? '-' }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Item Pesanan --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="font-semibold text-gray-800 mb-4">Buku yang Dipesan</h2>
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex gap-4 items-center border-b border-gray-100 pb-4 last:border-0 last:pb-0">
                    <img src="{{ $item->book->cover_image }}" alt="{{ $item->book->title }}"
                         class="w-14 h-18 object-cover rounded-lg shadow-sm flex-shrink-0">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">{{ $item->book->title }}</p>
                        <p class="text-xs text-gray-500">{{ $item->book->author }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm">Rp {{ number_format($item->price, 0, ',', '.') }} x{{ $item->quantity }}</p>
                        <p class="font-bold text-purple-700">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                <span class="font-semibold">Total Pembayaran (saat tiba)</span>
                <span class="text-2xl font-bold text-purple-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Info Pesanan --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-4">Info Pesanan</h2>
            <dl class="space-y-3 text-sm">
                <div>
                    <dt class="text-gray-500 text-xs">Kode Pesanan</dt>
                    <dd class="font-mono font-semibold text-purple-600">{{ $order->order_code }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs">Status</dt>
                    <dd class="font-medium">{{ ucfirst($order->status) }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs">Pembayaran</dt>
                    <dd class="text-orange-600 text-xs bg-orange-50 px-2 py-1 rounded">Payment at Delivery</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs">Tanggal Pesan</dt>
                    <dd>{{ $order->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs">Alamat Pengiriman</dt>
                    <dd class="text-gray-700 leading-relaxed">{{ $order->shipping_address }}</dd>
                </div>
                @if($order->notes)
                <div>
                    <dt class="text-gray-500 text-xs">Catatan</dt>
                    <dd class="text-gray-700">{{ $order->notes }}</dd>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
