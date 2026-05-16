<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // # Tampilkan semua pesan dari user
    public function index()
    {
        $messages = Message::with('user')->latest()->paginate(10);

        return view('admin.messages.index', compact('messages'));
    }

    // # Balas pesan user
    public function reply(Request $request, Message $message)
    {
        $request->validate(['reply' => 'required|string']);

        $message->update([
            'reply'      => $request->reply,
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim.');
    }
}
