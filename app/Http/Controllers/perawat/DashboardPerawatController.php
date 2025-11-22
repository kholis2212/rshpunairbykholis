<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Ambil ID perawat dari user yang login
        $user = Auth::user();
        
        // Hitung statistik untuk dashboard perawat
        $totalRekamMedis = RekamMedis::count();
        $rekamMedisHariIni = RekamMedis::whereDate('created_at', today())->count();
        $totalPasien = Pet::count();
        
        // Ambil rekam medis terbaru (perawat bisa lihat semua rekam medis)
        $rekamMedisTerbaru = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('perawat.dashboard-perawat', compact(
            'totalRekamMedis',
            'rekamMedisHariIni',
            'totalPasien',
            'rekamMedisTerbaru'
        ));
    }
}