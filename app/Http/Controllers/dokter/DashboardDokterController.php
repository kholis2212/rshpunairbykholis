<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Ambil ID dokter dari user yang login
        $user = Auth::user();
        $dokterId = $user->iduser;

        // Hitung statistik untuk dashboard
        $totalRekamMedis = RekamMedis::where('dokter_pemeriksa', $dokterId)->count();
        $rekamMedisHariIni = RekamMedis::where('dokter_pemeriksa', $dokterId)
            ->whereDate('created_at', today())
            ->count();
        
        // Ambil rekam medis terbaru
        $rekamMedisTerbaru = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan'])
            ->where('dokter_pemeriksa', $dokterId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dokter.dashboard-dokter', compact(
            'totalRekamMedis',
            'rekamMedisHariIni',
            'rekamMedisTerbaru'
        ));
    }
}