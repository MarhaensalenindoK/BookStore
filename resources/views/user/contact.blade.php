@extends('layouts.app')

@section('title', 'Hubungi Admin - Marhaensa Store')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Hubungi Admin</h1>
        <p class="text-gray-500 text-sm mt-1">Ada pertanyaan atau keluhan? Kirimkan pesan ke admin kami.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
        <h2 class="font-semibold text-gray-800 mb-4">Kirim Pesan Baru</h2>
        <form action="{{ route('user.contact.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjek <span class="text-red-500">*</span></label>
                <input type="text" name="subject" value="{{ old('subject') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    placeholder="Subjek pesan Anda...">
                @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                <textarea name="body" rows="4" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                    placeholder="Tulis pesan Anda di sini...">{{ old('body') }}</textarea>
                @error('body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:opacity-90 transition"
                style="background: linear-gradient(135deg, #462C7D, #D552A3)">
                📤 Kirim Pesan
            </button>
        </form>
    </div>

    {{-- Riwayat Pesan --}}
    @if($messages->isNotEmpty())
    <div class="space-y-4">
        <h2 class="font-semibold text-gray-800">Riwayat Pesan Anda</h2>
        @foreach($messages as $msg)
        <div class="bg-white rounded-xl shadow-sm p-5">
            <div class="flex items-start justify-between mb-2">
                <p class="font-medium text-gray-800 text-sm">{{ $msg->subject }}</p>
                @if($msg->reply)
                    <span class="bg-green-100 text-green-700 text-xs px-2 py-0.5 rounded-full">Dibalas</span>
                @else
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-0.5 rounded-full">Menunggu Balasan</span>
                @endif
            </div>
            <p class="text-sm text-gray-600 bg-gray-50 rounded-lg p-3 mb-2">{{ $msg->body }}</p>
            @if($msg->reply)
            <div class="bg-purple-50 border border-purple-200 rounded-lg p-3">
                <p class="text-xs text-purple-500 mb-1">Balasan Admin · {{ $msg->replied_at?->format('d M Y') }}</p>
                <p class="text-sm text-purple-800">{{ $msg->reply }}</p>
            </div>
            @endif
            <p class="text-xs text-gray-400 mt-2">{{ $msg->created_at->format('d M Y, H:i') }}</p>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
