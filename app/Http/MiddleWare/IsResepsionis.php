<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsResepsionis
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roleUsers->first()->role->nama_role === 'Resepsionis') {
            return $next($request);
        }
        return redirect('/home')->with('error', 'Akses ditolak');
    }
}