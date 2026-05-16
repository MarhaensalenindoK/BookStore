@extends('layouts.admin')

@section('title', 'List Pesanan')
@section('page-title', 'List Pesanan')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Total: <strong>{{ $orders->total() }}</strong> pesanan</p>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Kode Order</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">User</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Total</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Pembayaran</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Status</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Tanggal</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-2 font-mono text-xs text-purple-600 font-medium">{{ $order->order_code }}</td>
                    <td class="py-3 px-2 text-gray-700">{{ $order->user->name }}</td>
                    <td class="py-3 px-2 font-medium">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="py-3 px-2 text-xs text-gray-500">Payment at Delivery</td>
                    <td class="py-3 px-2">
                        @php
                            $colors = ['pending' => 'bg-yellow-100 text-yellow-700', 'confirmed' => 'bg-blue-100 text-blue-700', 'shipped' => 'bg-indigo-100 text-indigo-700', 'delivered' => 'bg-green-100 text-green-700', 'cancelled' => 'bg-red-100 text-red-700'];
                        @endphp
                        <span class="{{ $colors[$order->status] ?? 'bg-gray-100 text-gray-700' }} text-xs px-2 py-1 rounded-full">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-2 text-gray-400 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="py-3 px-2">
                        <a href="{{ route('admin.orders.show', $order) }}" class="bg-purple-100 text-purple-600 px-3 py-1 rounded text-xs hover:bg-purple-200 transition">Detail</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-10 text-center text-gray-400">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection
