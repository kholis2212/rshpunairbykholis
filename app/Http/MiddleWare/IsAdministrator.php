<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdministrator
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->roleUsers->first()->role->nama_role === 'Administrator') {
            return $next($request);
        }
        return redirect('/home')->with('error', 'Akses ditolak');
    }
}