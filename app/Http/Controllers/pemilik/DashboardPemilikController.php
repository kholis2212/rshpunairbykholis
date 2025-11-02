<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        // Pemilik lihat data pet miliknya saja
        $pet = Pet::with('rasHewan')->whereHas('pemilik', function($q) {
            $q->where('iduser', Auth::id());
        })->get();
        return view('dashboard.pemilik', compact('pet'));
    }
}