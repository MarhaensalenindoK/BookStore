@extends('layouts.app')

@section('title', $book->title . ' - Marhaensa Store')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    {{-- Cover Buku --}}
    <div class="md:col-span-1">
        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
             class="w-full rounded-xl shadow-lg max-w-xs mx-auto">
    </div>

    {{-- Detail Buku --}}
    <div class="md:col-span-2">
        <span class="text-xs bg-pink-100 text-pink-600 px-3 py-1 rounded-full">{{ $book->category->name }}</span>
        <h1 class="text-2xl font-bold text-gray-800 mt-3 mb-1">{{ $book->title }}</h1>
        <p class="text-gray-500 mb-4">oleh <strong>{{ $book->author }}</strong> | {{ $book->publisher }} ({{ $book->year }})</p>

        <div class="flex items-center gap-6 mb-6">
            <div>
                <p class="text-sm text-gray-500">Harga</p>
                <p class="text-3xl font-bold text-purple-700">Rp {{ number_format($book->price, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Stok</p>
                <p class="text-lg font-semibold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $book->stock > 0 ? $book->stock . ' tersedia' : 'Habis' }}
                </p>
            </div>
        </div>

        @if($book->description)
        <div class="mb-6">
            <h3 class="font-semibold text-gray-700 mb-2">Deskripsi</h3>
            <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
        </div>
        @endif

        @if($book->stock > 0)
        <form action="{{ route('user.cart.store') }}" method="POST" class="flex items-center gap-4">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                <span class="px-4 py-2 text-sm text-gray-600">Jumlah</span>
                <input type="number" name="quantity" value="1" min="1" max="{{ $book->stock }}"
                    class="w-16 py-2 text-center text-sm border-l border-gray-300 focus:outline-none">
            </div>
            <button type="submit" class="text-white px-8 py-2.5 rounded-xl font-medium hover:opacity-90 transition"
                style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                🛒 Tambah ke Keranjang
            </button>
        </form>
        @else
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
            Maaf, buku ini sedang tidak tersedia.
        </div>
        @endif
    </div>
</div>

{{-- Buku Terkait --}}
@if($related->isNotEmpty())
<div class="mt-12">
    <h2 class="text-xl font-bold text-gray-800 mb-5">Buku Serupa</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        @foreach($related as $rel)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
            <a href="{{ route('user.books.show', $rel) }}">
                <img src="{{ $rel->cover_image }}" alt="{{ $rel->title }}" class="w-full h-48 object-cover">
            </a>
            <div class="p-3">
                <h4 class="font-medium text-gray-800 text-sm line-clamp-2">{{ $rel->title }}</h4>
                <p class="text-xs text-gray-500 mt-1">{{ $rel->author }}</p>
                <p class="font-bold text-purple-700 text-sm mt-2">Rp {{ number_format($rel->price, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
