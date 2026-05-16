<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Marhaensa Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #462C7D 0%, #831C91 33%, #D552A3 66%, #FF70BF 100%); }
        .gradient-text { background: linear-gradient(135deg, #462C7D, #D552A3); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

    {{-- Navbar minimal --}}
    <nav class="gradient-bg text-white shadow-lg py-4">
        <div class="max-w-4xl mx-auto px-6 flex items-center justify-between">
            <a href="{{ route('login') }}" class="text-xl font-bold">📚 Marhaensa Store</a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="px-4 py-1.5 rounded-full text-sm hover:bg-white/20 transition">Login</a>
                <a href="{{ route('register') }}" class="bg-white/20 hover:bg-white/30 px-4 py-1.5 rounded-full text-sm transition">Daftar</a>
            </div>
        </div>
    </nav>

    {{-- Hero About --}}
    <div class="gradient-bg text-white py-16 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-6xl mb-4">📚</div>
            <h1 class="text-4xl font-bold mb-3">Marhaensa Store</h1>
            <p class="text-pink-200 text-lg">Toko Buku Online Terpercaya sejak 2022</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 py-12">
        {{-- Tentang Kami --}}
        <div class="bg-white rounded-2xl shadow-sm p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Tentang Kami</h2>
            <p class="text-gray-600 leading-relaxed mb-4">
                <strong>Marhaensa Store</strong> adalah toko buku online yang berdiri pada tahun <strong>2022</strong>.
                Kami hadir untuk memudahkan masyarakat Indonesia dalam mengakses berbagai koleksi buku berkualitas
                dari berbagai genre dan kategori, mulai dari novel, teknologi, pendidikan, bisnis, hingga pengembangan diri.
            </p>
            <p class="text-gray-600 leading-relaxed mb-4">
                Dengan semangat "Buku untuk Semua", kami berkomitmen untuk menyediakan koleksi buku terlengkap
                dengan harga yang terjangkau dan layanan pengiriman yang cepat ke seluruh penjuru Indonesia.
            </p>
            <p class="text-gray-600 leading-relaxed">
                Kami percaya bahwa membaca adalah investasi terbaik untuk masa depan. Setiap buku yang Anda beli
                dari Marhaensa Store adalah langkah menuju versi terbaik diri Anda.
            </p>
        </div>

        {{-- Keunggulan --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border-t-4" style="border-color: #462C7D">
                <div class="text-4xl mb-3">📖</div>
                <h3 class="font-semibold text-gray-800 mb-2">Koleksi Lengkap</h3>
                <p class="text-gray-500 text-sm">Ratusan judul buku dari berbagai kategori dan genre tersedia untuk Anda.</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border-t-4" style="border-color: #D552A3">
                <div class="text-4xl mb-3">🚚</div>
                <h3 class="font-semibold text-gray-800 mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-500 text-sm">Kami memastikan buku sampai ke tangan Anda dalam kondisi terbaik dan tepat waktu.</p>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 text-center border-t-4" style="border-color: #FF70BF">
                <div class="text-4xl mb-3">💳</div>
                <h3 class="font-semibold text-gray-800 mb-2">Bayar di Tempat</h3>
                <p class="text-gray-500 text-sm">Sistem Payment at Delivery memastikan Anda membayar setelah buku tiba di tangan Anda.</p>
            </div>
        </div>

        {{-- Statistik --}}
        <div class="rounded-2xl text-white p-8 mb-8 grid grid-cols-3 gap-6 text-center" style="background: linear-gradient(135deg, #462C7D 0%, #831C91 50%, #D552A3 100%)">
            <div>
                <p class="text-3xl font-bold">2022</p>
                <p class="text-pink-200 text-sm mt-1">Tahun Berdiri</p>
            </div>
            <div>
                <p class="text-3xl font-bold">-+</p>
                <p class="text-pink-200 text-sm mt-1">Judul Buku</p>
            </div>
            <div>
                <p class="text-3xl font-bold">-+</p>
                <p class="text-pink-200 text-sm mt-1">Pelanggan Puas</p>
            </div>
        </div>

        {{-- CTA --}}
        <div class="text-center">
            <p class="text-gray-600 mb-4">Tertarik bergabung dengan komunitas pembaca Marhaensa Store?</p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('register') }}" class="text-white px-8 py-3 rounded-xl font-medium hover:opacity-90 transition"
                   style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="border-2 border-purple-600 text-purple-700 px-8 py-3 rounded-xl font-medium hover:bg-purple-50 transition">
                    Masuk
                </a>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="gradient-bg text-white py-8 mt-8">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <p class="font-semibold">📚 Marhaensa Store</p>
            <p class="text-sm text-pink-200 mt-1">Berdiri sejak tahun 2022 · Toko buku terpercaya pilihan keluarga</p>
            <p class="text-xs text-pink-300 mt-3">© {{ date('Y') }} Marhaensa Store. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
