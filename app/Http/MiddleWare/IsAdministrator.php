<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdministrator
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Ambil role aktif user (status = 1)
        $activeRole = $user->roleUsers->where('status', 1)->first();

        // Jika tidak ada role aktif
        if (!$activeRole) {
            return redirect('/beranda')->with('error', 'Akun anda tidak terdaftar sebagai role aktif.');
        }

        // Cek apakah role-nya Administrator
        if ($activeRole->role->nama_role === 'Administrator') {
            return $next($request);
        }

        return redirect('/beranda')->with('error', 'Akses ditolak. Anda bukan Administrator.');
    }
}
