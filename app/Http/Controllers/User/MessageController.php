<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // # Tampilkan form kontak admin
    public function show()
    {
        $messages = Message::where('user_id', session('user_id'))->latest()->get();

        return view('user.contact', compact('messages'));
    }

    // # Kirim pesan ke admin
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:150',
            'body'    => 'required|string',
        ]);

        Message::create([
            'user_id' => session('user_id'),
            'subject' => $request->subject,
            'body'    => $request->body,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim ke admin.');
    }
}
