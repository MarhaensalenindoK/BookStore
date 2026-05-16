@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan: ' . $order->order_code)

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Detail Pesanan --}}
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Item yang Dipesan</h3>
            <div class="space-y-3">
                @foreach($order->orderItems as $item)
                <div class="flex items-center gap-4 py-3 border-b border-gray-100 last:border-0">
                    <img src="{{ $item->book->cover_image }}" class="w-12 h-16 object-cover rounded shadow-sm">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800 text-sm">{{ $item->book->title }}</p>
                        <p class="text-xs text-gray-500">{{ $item->book->author }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">x{{ $item->quantity }}</p>
                        <p class="text-sm font-semibold text-purple-600">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                <span class="font-semibold text-gray-700">Total Pembayaran</span>
                <span class="text-xl font-bold text-purple-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- Update Pengiriman --}}
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h3 class="font-semibold text-gray-800 mb-4">🚚 Update Data Pengiriman</h3>
            <form action="{{ route('admin.shipping.store', $order) }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pengiriman</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-purple-500">
                            <option value="processing" {{ optional($order->shipping)->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ optional($order->shipping)->status == 'shipped' ? 'selected' : '' }}>Shipped (Dikirim)</option>
                            <option value="delivered" {{ optional($order->shipping)->status == 'delivered' ? 'selected' : '' }}>Delivered (Selesai)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Resi</label>
                        <input type="text" name="tracking_number" value="{{ optional($order->shipping)->tracking_number }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-purple-500"
                            placeholder="JNE123456...">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Tiba</label>
                        <input type="date" name="estimated_date" value="{{ optional($order->shipping)->estimated_date?->format('Y-m-d') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <input type="text" name="notes" value="{{ optional($order->shipping)->notes }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-purple-500"
                            placeholder="Catatan pengiriman...">
                    </div>
                </div>
                <button type="submit" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:opacity-90 transition">
                    Simpan Data Pengiriman
                </button>
            </form>
        </div>
    </div>

    {{-- Sidebar Info --}}
    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3">Informasi Pesanan</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-gray-500">Kode Order</dt>
                    <dd class="font-mono text-purple-600 font-medium">{{ $order->order_code }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Status</dt>
                    <dd class="font-medium">{{ ucfirst($order->status) }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Pembayaran</dt>
                    <dd class="text-xs bg-orange-100 text-orange-700 px-2 py-0.5 rounded">Payment at Delivery</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-gray-500">Tanggal</dt>
                    <dd>{{ $order->created_at->format('d M Y, H:i') }}</dd>
                </div>
            </dl>

            <hr class="my-3">

            {{-- Update Status Order --}}
            <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                @csrf @method('PATCH')
                <label class="block text-sm font-medium text-gray-700 mb-1">Ubah Status Order</label>
                <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm mb-2">
                    @foreach(['pending', 'confirmed', 'shipped', 'delivered', 'cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full bg-gray-800 text-white py-2 rounded-lg text-xs hover:bg-gray-700 transition">Update Status</button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="font-semibold text-gray-800 mb-3">Informasi Penerima</h3>
            <dl class="space-y-2 text-sm">
                <div>
                    <dt class="text-gray-500 text-xs">Nama</dt>
                    <dd class="font-medium">{{ $order->user->name }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs">Username</dt>
                    <dd>{{ $order->user->username }}</dd>
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

        <a href="{{ route('admin.orders.index') }}" class="block text-center text-sm text-purple-600 hover:underline">← Kembali ke list pesanan</a>
    </div>
</div>
@endsection
