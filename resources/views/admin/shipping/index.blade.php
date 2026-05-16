@extends('layouts.admin')

@section('title', 'Status Pengiriman')
@section('page-title', 'Status Pengiriman')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Kode Order</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Penerima</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Nomor Resi</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Status</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Estimasi Tiba</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Catatan</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($shippings as $shipping)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-2 font-mono text-xs text-purple-600">{{ $shipping->order->order_code }}</td>
                    <td class="py-3 px-2">{{ $shipping->order->user->name }}</td>
                    <td class="py-3 px-2 font-mono text-xs">{{ $shipping->tracking_number ?? '-' }}</td>
                    <td class="py-3 px-2">
                        @php
                            $sc = ['processing' => 'bg-yellow-100 text-yellow-700', 'shipped' => 'bg-blue-100 text-blue-700', 'delivered' => 'bg-green-100 text-green-700'];
                        @endphp
                        <span class="{{ $sc[$shipping->status] ?? '' }} text-xs px-2 py-1 rounded-full">{{ ucfirst($shipping->status) }}</span>
                    </td>
                    <td class="py-3 px-2 text-gray-500 text-xs">{{ $shipping->estimated_date ? $shipping->estimated_date->format('d M Y') : '-' }}</td>
                    <td class="py-3 px-2 text-gray-500 text-xs max-w-xs truncate">{{ $shipping->notes ?? '-' }}</td>
                    <td class="py-3 px-2">
                        <a href="{{ route('admin.orders.show', $shipping->order) }}" class="bg-purple-100 text-purple-600 px-3 py-1 rounded text-xs hover:bg-purple-200 transition">Update</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-10 text-center text-gray-400">Belum ada data pengiriman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $shippings->links() }}</div>
</div>
@endsection
