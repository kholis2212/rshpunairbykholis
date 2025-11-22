<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Hitung statistik untuk dashboard
        $totalPemilik = Pemilik::count();
        $totalPet = Pet::count();
        $temuDokterHariIni = TemuDokter::whereDate('waktu_daftar', today())->count();
        $temuDokterMenunggu = TemuDokter::where('status', 'M')->whereDate('waktu_daftar', today())->count();

        // Ambil daftar temu dokter hari ini
        $temuDokterHariIniList = TemuDokter::with(['pet', 'pet.pemilik.user', 'userDokter'])
            ->whereDate('waktu_daftar', today())
            ->orderBy('no_urut', 'asc')
            ->limit(5)
            ->get();

        return view('resepsionis.dashboard-resepsionis', compact(
            'totalPemilik',
            'totalPet',
            'temuDokterHariIni',
            'temuDokterMenunggu',
            'temuDokterHariIniList'
        ));
    }
}