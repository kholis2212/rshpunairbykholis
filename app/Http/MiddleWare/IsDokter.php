<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsDokter
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek apakah user memiliki role dokter
        $user = Auth::user();
        $isDokter = \Illuminate\Support\Facades\DB::table('role_user as ru')
            ->join('role as r', 'ru.idrole', '=', 'r.idrole')
            ->where('ru.iduser', $user->iduser)
            ->where('r.nama_role', 'Dokter')
            ->where('ru.status', 1)
            ->exists();

        if (!$isDokter) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}