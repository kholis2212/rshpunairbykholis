<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    public function index()
    {
        // Ambil data pemilik berdasarkan user login
        $pemilik = Pemilik::where('iduser', Auth::id())->first();

        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        // ID pemilik (biar tidak error)
        $idPemilik = $pemilik->idpemilik;

        // Statistik
        $totalPets = Pet::where('idpemilik', $idPemilik)->count();

        $totalReservasi = TemuDokter::whereHas('pet', function ($q) use ($idPemilik) {
            $q->where('idpemilik', $idPemilik);
        })->count();

        $totalRekamMedis = RekamMedis::whereHas('pet', function ($q) use ($idPemilik) {
            $q->where('idpemilik', $idPemilik);
        })->count();

        // Reservasi hari ini
        $reservasiHariIni = TemuDokter::whereHas('pet', function ($q) use ($idPemilik) {
            $q->where('idpemilik', $idPemilik);
        })
        ->whereDate('waktu_daftar', now()->toDateString())
        ->with(['pet.rasHewan.jenisHewan', 'dokter.user'])
        ->orderBy('waktu_daftar', 'asc')
        ->get();

        // Reservasi terbaru (LIMIT 5)
        $reservasiTerbaru = TemuDokter::whereHas('pet', function ($q) use ($idPemilik) {
            $q->where('idpemilik', $idPemilik);
        })
        ->with(['pet.rasHewan.jenisHewan'])
        ->orderBy('waktu_daftar', 'desc')
        ->limit(5)
        ->get();

        // Rekam medis terbaru (LIMIT 5)
        $rekamMedisTerbaru = RekamMedis::whereHas('pet', function ($q) use ($idPemilik) {
            $q->where('idpemilik', $idPemilik);
        })
        ->with(['pet.rasHewan.jenisHewan', 'dokterPemeriksa.user'])
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

        // RETURN VIEW (TIDAK ADA DOUBLE LAGI)
        return view('pemilik.dashboard-pemilik', [
            'totalPets' => $totalPets,
            'totalReservasi' => $totalReservasi,
            'totalRekamMedis' => $totalRekamMedis,
            'reservasiHariIni' => $reservasiHariIni,
            'reservasiTerbaru' => $reservasiTerbaru,
            'rekamMedisTerbaru' => $rekamMedisTerbaru,
        ]);
    }
}
