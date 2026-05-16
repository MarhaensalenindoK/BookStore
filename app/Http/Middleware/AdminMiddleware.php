<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    // # Cek apakah user login sebagai admin
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user_id') || session('role') !== 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        return $next($request);
    }
}
