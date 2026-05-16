<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Marhaensa Store')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #462C7D 0%, #831C91 33%, #D552A3 66%, #FF70BF 100%); }
        .sidebar-active { background: rgba(255,255,255,0.15); border-left: 3px solid #FF70BF; }
        .sidebar-link:hover { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 gradient-bg text-white flex flex-col min-h-screen fixed left-0 top-0 z-30">
        <div class="p-6 border-b border-white/20">
            <h1 class="text-xl font-bold">📚 Marhaensa Store</h1>
            <p class="text-xs text-pink-200 mt-1">Admin Panel</p>
        </div>

        <nav class="flex-1 py-4">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                <span>🏠</span> Dashboard
            </a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.users*') ? 'sidebar-active' : '' }}">
                <span>👥</span> Data User
            </a>
            <a href="{{ route('admin.books.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.books*') ? 'sidebar-active' : '' }}">
                <span>📖</span> Data Buku
            </a>
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.categories*') ? 'sidebar-active' : '' }}">
                <span>🏷️</span> Kategori
            </a>
            <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.orders*') ? 'sidebar-active' : '' }}">
                <span>📦</span> List Pesanan
            </a>
            <a href="{{ route('admin.shipping.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.shipping*') ? 'sidebar-active' : '' }}">
                <span>🚚</span> Status Pengiriman
            </a>
            {{-- <a href="{{ route('admin.messages.index') }}" class="sidebar-link flex items-center gap-3 px-6 py-3 text-sm {{ request()->routeIs('admin.messages*') ? 'sidebar-active' : '' }}">
                <span>✉️</span> Pesan User
            </a> --}}
        </nav>

        <div class="p-4 border-t border-white/20">
            <p class="text-xs text-pink-200 mb-2">Login sebagai:</p>
            <p class="text-sm font-medium">{{ session('name') }}</p>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="w-full text-xs bg-white/20 hover:bg-white/30 text-white py-2 rounded-lg transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <main class="ml-64 flex-1 flex flex-col min-h-screen">
        {{-- Top Bar --}}
        <header class="gradient-bg text-white px-8 py-4 flex items-center justify-between shadow-md">
            <h2 class="text-lg font-semibold">@yield('page-title', 'Dashboard')</h2>
            <span class="text-sm text-pink-200">{{ date('d M Y') }}</span>
        </header>

        {{-- Alert Messages --}}
        <div class="px-8 pt-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <div class="flex-1 p-8 pt-4">
            @yield('content')
        </div>
    </main>
</body>
</html>
