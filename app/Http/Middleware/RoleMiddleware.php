<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role  // Parameter role yang diterima
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // 1. Pastikan user sudah login menggunakan Auth facade
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Cek role user
        if (Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak: Role tidak sesuai');
        }

        return $next($request);
    }
}