@extends('layouts.admin')

@section('title', 'Pesan dari User')
@section('page-title', 'Pesan dari User')

@section('content')
<div class="space-y-4">
    @forelse($messages as $msg)
    <div class="bg-white rounded-xl shadow-sm p-5">
        <div class="flex items-start justify-between mb-3">
            <div>
                <p class="font-semibold text-gray-800">{{ $msg->subject }}</p>
                <p class="text-xs text-gray-400 mt-0.5">dari <strong>{{ $msg->user->name }}</strong> ({{ $msg->user->username }}) · {{ $msg->created_at->format('d M Y, H:i') }}</p>
            </div>
            @if($msg->reply)
                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full">Sudah Dibalas</span>
            @else
                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Belum Dibalas</span>
            @endif
        </div>

        <div class="bg-gray-50 rounded-lg p-3 text-sm text-gray-700 mb-3">
            {{ $msg->body }}
        </div>

        @if($msg->reply)
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-sm text-purple-800 mb-3">
            <p class="text-xs text-purple-500 mb-1">Balasan Admin · {{ $msg->replied_at?->format('d M Y, H:i') }}</p>
            {{ $msg->reply }}
        </div>
        @else
        <form action="{{ route('admin.messages.reply', $msg) }}" method="POST" class="flex gap-3">
            @csrf
            <textarea name="reply" rows="2" required placeholder="Ketik balasan Anda..."
                class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"></textarea>
            <button type="submit" class="bg-gradient-to-r from-purple-700 to-pink-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:opacity-90 transition h-fit self-end">
                Balas
            </button>
        </form>
        @endif
    </div>
    @empty
    <div class="bg-white rounded-xl shadow-sm p-10 text-center text-gray-400">
        Belum ada pesan dari user.
    </div>
    @endforelse

    <div class="mt-4">{{ $messages->links() }}</div>
</div>
@endsection
