<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // # Tampilkan form registrasi
    public function show()
    {
        if (session('user_id')) {
            return redirect()->route('user.home');
        }

        return view('auth.register');
    }

    // # Proses registrasi user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:1|confirmed',
            'email'    => 'nullable|email|max:100',
            'phone'    => 'nullable|string|max:20',
            'address'  => 'nullable|string',
        ], [
            'username.unique'       => 'Username sudah digunakan, pilih username lain.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'email'    => $request->email,
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        session([
            'user_id'  => $user->id,
            'username' => $user->username,
            'name'     => $user->name,
            'role'     => 'user',
        ]);

        return redirect()->route('user.home')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '!');
    }
}
