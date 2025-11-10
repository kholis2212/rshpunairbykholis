<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Resepsionis lihat data pendaftaran (pet dan pemilik)
        $pet = Pet::with('pemilik.user', 'rasHewan')->get();
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.dashboard-resepsionis', compact('pet', 'pemilik'));
    }
}