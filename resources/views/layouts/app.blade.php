<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Marhaensa Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #462C7D 0%, #831C91 40%, #D552A3 75%, #FF70BF 100%); }
        .gradient-text { background: linear-gradient(135deg, #462C7D, #D552A3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .gradient-btn { background: linear-gradient(135deg, #462C7D, #831C91, #D552A3); }
        .gradient-btn:hover { background: linear-gradient(135deg, #3a2468, #6a1778, #b8448a); }
        .card-hover:hover { transform: translateY(-3px); box-shadow: 0 10px 30px rgba(70,44,125,0.2); }
        .card-hover { transition: all 0.3s ease; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Navbar --}}
    <nav class="gradient-bg text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('user.home') }}" class="text-xl font-bold flex items-center gap-2">
                📚 Marhaensa Store
            </a>
            <div class="flex items-center gap-6">
                <a href="{{ route('user.home') }}" class="text-sm hover:text-pink-200 transition">Beranda</a>
                <a href="{{ route('about') }}" class="text-sm hover:text-pink-200 transition">About Us</a>
                {{-- <a href="{{ route('user.contact') }}" class="text-sm hover:text-pink-200 transition">Kontak</a> --}}
                <a href="{{ route('user.orders.index') }}" class="text-sm hover:text-pink-200 transition">Pesanan Saya</a>
                <a href="{{ route('user.cart') }}" class="relative text-sm hover:text-pink-200 transition">
                    🛒 Keranjang
                </a>
                <div class="flex items-center gap-2 text-sm border-l border-white/30 pl-4">
                    <span class="text-pink-200">👤 {{ session('name') }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-xs transition">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Alert Messages --}}
    <div class="max-w-7xl mx-auto px-6 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Page Content --}}
    <main class="max-w-7xl mx-auto px-6 py-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="gradient-bg text-white mt-12 py-8">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="font-semibold text-lg">📚 Marhaensa Store</p>
            <p class="text-sm text-pink-200 mt-1">Berdiri sejak tahun 2022 · Toko buku terpercaya pilihan keluarga</p>
            <p class="text-xs text-pink-300 mt-3">© {{ date('Y') }} Marhaensa Store. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
