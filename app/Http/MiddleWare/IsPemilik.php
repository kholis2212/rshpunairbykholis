<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPemilik
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleUser = $user->roleUsers->first(); // ambil relasi pertama (bisa null)
            
            // Cek apakah user punya role dan namanya Pemilik
            if ($roleUser && $roleUser->role && $roleUser->role->nama_role === 'Pemilik') {
                return $next($request);
            }
        }

        // Kalau belum login atau bukan Pemilik
        return redirect('/home')->with('error', 'Akses ditolak');
    }
}
