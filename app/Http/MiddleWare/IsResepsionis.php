<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsResepsionis
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();
        $activeRole = $user->roleUsers->where('status', 1)->first();

        if (!$activeRole) {
            return redirect('/home')->with('error', 'Akun anda tidak terdaftar sebagai role aktif.');
        }

        if ($activeRole->role && $activeRole->role->nama_role === 'Resepsionis') {
            return $next($request);
        }

        return redirect('/home')->with('error', 'Akses ditolak. Anda bukan Resepsionis.');
    }
}
