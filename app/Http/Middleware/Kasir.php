<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Kasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login dan memiliki role 'kasir'
        if (Auth::check() && Auth::user()->usertype == 'owner') {
            return $next($request);  // Lanjutkan ke request berikutnya
        }

        // Jika tidak login atau role tidak sesuai, redirect ke halaman login
        return redirect('/login');
    }
}
