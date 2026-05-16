@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Kartu Statistik --}}
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-purple-600 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Total User</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
        <p class="text-xs text-gray-400 mt-1">👥 Terdaftar</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-pink-500 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Total Buku</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_books'] }}</p>
        <p class="text-xs text-gray-400 mt-1">📖 Dalam katalog</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-indigo-500 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Total Pesanan</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['total_orders'] }}</p>
        <p class="text-xs text-gray-400 mt-1">📦 Semua status</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-yellow-400 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Pending</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['pending_orders'] }}</p>
        <p class="text-xs text-gray-400 mt-1">⏳ Perlu konfirmasi</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-red-400 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Pesan Belum Dibalas</p>
        <p class="text-2xl font-bold text-gray-800">{{ $stats['unread_messages'] }}</p>
        <p class="text-xs text-gray-400 mt-1">✉️ Dari user</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-green-500 col-span-1">
        <p class="text-xs text-gray-500 mb-1">Total Pendapatan</p>
        <p class="text-lg font-bold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
        <p class="text-xs text-gray-400 mt-1">💰 Order selesai</p>
    </div>
</div>

{{-- Pesanan Terbaru --}}
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-4">
        <h3 class="font-semibold text-gray-800">Pesanan Terbaru</h3>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-purple-600 hover:underline">Lihat semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-2 text-gray-500 font-medium">Kode Order</th>
                    <th class="text-left py-2 text-gray-500 font-medium">User</th>
                    <th class="text-left py-2 text-gray-500 font-medium">Total</th>
                    <th class="text-left py-2 text-gray-500 font-medium">Status</th>
                    <th class="text-left py-2 text-gray-500 font-medium">Tanggal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recent_orders as $order)
                <tr>
                    <td class="py-3 font-mono text-xs text-purple-600">{{ $order->order_code }}</td>
                    <td class="py-3">{{ $order->user->name }}</td>
                    <td class="py-3">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="py-3">
                        @php
                            $colors = ['pending' => 'yellow', 'confirmed' => 'blue', 'shipped' => 'indigo', 'delivered' => 'green', 'cancelled' => 'red'];
                            $color = $colors[$order->status] ?? 'gray';
                        @endphp
                        <span class="bg-{{ $color }}-100 text-{{ $color }}-700 text-xs px-2 py-1 rounded-full">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 text-gray-400 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
