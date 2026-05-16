<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // # Tampilkan form login
    public function show()
    {
        if (session('user_id')) {
            return session('role') === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.home');
        }

        return view('auth.login');
    }

    // # Proses login - cek username dan password
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Username atau password salah.')->withInput();
        }

        session([
            'user_id'  => $user->id,
            'username' => $user->username,
            'name'     => $user->name,
            'role'     => $user->role,
        ]);

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return redirect()->route('user.home')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    // # Proses logout
    public function logout()
    {
        session()->flush();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}
