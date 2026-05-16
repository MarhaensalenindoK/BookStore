@extends('layouts.admin')

@section('title', 'Data Buku')
@section('page-title', 'Data Buku')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Total: <strong>{{ $books->total() }}</strong> buku</p>
        <a href="{{ route('admin.books.create') }}" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition">
            + Tambah Buku
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Cover</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Judul</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Penulis</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Kategori</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Harga</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Stok</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($books as $book)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-2">
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                             class="w-10 h-14 object-cover rounded shadow-sm">
                    </td>
                    <td class="py-3 px-2 font-medium text-gray-800 max-w-xs">{{ $book->title }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $book->author }}</td>
                    <td class="py-3 px-2">
                        <span class="bg-pink-100 text-pink-700 text-xs px-2 py-0.5 rounded-full">{{ $book->category->name }}</span>
                    </td>
                    <td class="py-3 px-2 text-gray-700 font-medium">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                    <td class="py-3 px-2">
                        <span class="{{ $book->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} text-xs px-2 py-0.5 rounded-full">
                            {{ $book->stock }}
                        </span>
                    </td>
                    <td class="py-3 px-2">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.books.edit', $book) }}" class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs hover:bg-blue-200 transition">Edit</a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="py-10 text-center text-gray-400">Belum ada buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $books->links() }}</div>
</div>
@endsection
