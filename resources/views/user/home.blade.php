@extends('layouts.app')

@section('title', 'Beranda - Marhaensa Store')

@section('content')
{{-- Hero + Search --}}
<div class="rounded-2xl overflow-hidden mb-8 p-8 text-white text-center" style="background: linear-gradient(135deg, #462C7D 0%, #831C91 40%, #D552A3 75%, #FF70BF 100%);">
    <h1 class="text-3xl font-bold mb-2">Selamat Datang di Marhaensa Store 📚</h1>
    <p class="text-pink-200 mb-6">Temukan buku favoritmu dari koleksi kami yang lengkap</p>

    <form action="{{ route('user.home') }}" method="GET" class="max-w-xl mx-auto flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
            class="flex-1 px-4 py-2.5 rounded-xl text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-pink-300"
            placeholder="Cari judul buku atau nama penulis...">
        <button type="submit" class="bg-white/20 hover:bg-white/30 px-5 py-2.5 rounded-xl text-sm font-medium transition border border-white/40">
            🔍 Cari
        </button>
    </form>
</div>

{{-- Filter Kategori --}}
<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('user.home') }}" class="px-4 py-1.5 rounded-full text-sm {{ !request('category') ? 'text-white' : 'bg-white border border-purple-300 text-purple-700 hover:bg-purple-50' }} transition"
       style="{{ !request('category') ? 'background: linear-gradient(135deg, #462C7D, #D552A3)' : '' }}">
        Semua
    </a>
    @foreach($categories as $cat)
    <a href="{{ route('user.home', ['category' => $cat->id, 'search' => request('search')]) }}"
       class="px-4 py-1.5 rounded-full text-sm {{ request('category') == $cat->id ? 'text-white' : 'bg-white border border-purple-300 text-purple-700 hover:bg-purple-50' }} transition"
       style="{{ request('category') == $cat->id ? 'background: linear-gradient(135deg, #462C7D, #D552A3)' : '' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>

{{-- Daftar Buku --}}
@if(request('search'))
<p class="text-sm text-gray-500 mb-4">Hasil pencarian: "<strong>{{ request('search') }}</strong>" — {{ $books->total() }} buku ditemukan</p>
@endif

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
    @forelse($books as $book)
    <div class="bg-white rounded-xl shadow-sm overflow-hidden card-hover">
        <a href="{{ route('user.books.show', $book) }}">
            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}"
                 class="w-full h-52 object-cover">
        </a>
        <div class="p-4">
            <span class="text-xs bg-pink-100 text-pink-600 px-2 py-0.5 rounded-full">{{ $book->category->name }}</span>
            <a href="{{ route('user.books.show', $book) }}" class="block mt-2">
                <h3 class="font-semibold text-gray-800 text-sm leading-tight line-clamp-2 hover:text-purple-700">{{ $book->title }}</h3>
            </a>
            <p class="text-xs text-gray-500 mt-1">{{ $book->author }}</p>
            <div class="flex items-center justify-between mt-3">
                <span class="font-bold text-purple-700">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                <span class="text-xs text-gray-400">Stok: {{ $book->stock }}</span>
            </div>
            <form action="{{ route('user.cart.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="w-full text-white text-xs py-2 rounded-lg font-medium transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                    🛒 Tambah ke Keranjang
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-4 py-16 text-center text-gray-400">
        <div class="text-5xl mb-4">📭</div>
        <p class="text-lg">Buku tidak ditemukan.</p>
        <a href="{{ route('user.home') }}" class="text-purple-600 text-sm hover:underline mt-2 block">Lihat semua buku</a>
    </div>
    @endforelse
</div>

<div class="mt-8">{{ $books->links() }}</div>
@endsection
