@extends('layouts.admin')

@section('title', 'Kategori Buku')
@section('page-title', 'Kategori Buku')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex items-center justify-between mb-6">
        <p class="text-sm text-gray-500">Total: <strong>{{ $categories->total() }}</strong> kategori</p>
        <a href="{{ route('admin.categories.create') }}" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-gray-200">
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">No</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Nama Kategori</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Slug</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Deskripsi</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Jumlah Buku</th>
                    <th class="text-left py-3 px-2 text-gray-600 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($categories as $i => $cat)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-2 text-gray-400">{{ $categories->firstItem() + $i }}</td>
                    <td class="py-3 px-2 font-medium text-gray-800">{{ $cat->name }}</td>
                    <td class="py-3 px-2"><span class="font-mono text-xs text-gray-500">{{ $cat->slug }}</span></td>
                    <td class="py-3 px-2 text-gray-500 max-w-xs truncate">{{ $cat->description ?? '-' }}</td>
                    <td class="py-3 px-2">
                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-0.5 rounded-full">{{ $cat->books_count }} buku</span>
                    </td>
                    <td class="py-3 px-2">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs hover:bg-blue-200 transition">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Semua buku dalam kategori ini juga akan terhapus.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200 transition">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="py-10 text-center text-gray-400">Belum ada kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection
