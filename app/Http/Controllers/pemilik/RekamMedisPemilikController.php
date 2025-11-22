<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\RekamMedis;
use App\Models\Pet;

class RekamMedisPemilikController extends Controller
{
    public function index()
    {
        // Ambil data pemilik berdasarkan user yang login
        $pemilik = Pemilik::where('iduser', Auth::id())->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        // Ambil semua rekam medis pets milik pemilik
        $rekamMedis = RekamMedis::whereHas('pet', function($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->with([
            'pet.rasHewan.jenisHewan',
            'dokterPemeriksa.user',
            'detailRekamMedis.kodeTindakanTerapi'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('pemilik.rekam-medis.index', compact('rekamMedis', 'pemilik'));
    }

    public function show($id)
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $rekamMedis = RekamMedis::whereHas('pet', function($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->where('idrekam_medis', $id)
        ->with([
            'pet.rasHewan.jenisHewan',
            'dokterPemeriksa.user', // Pastikan relasi ini ada
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])
        ->firstOrFail();

        // Debug: Cek apakah dokterPemeriksa ada
        // if (!$rekamMedis->dokterPemeriksa) {
        //     \Log::warning("DokterPemeriksa null untuk rekam medis ID: " . $id);
        // }

        return view('pemilik.rekam-medis.show', compact('rekamMedis'));
    }

    public function byPet($petId)
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        // Pastikan pet milik pemilik
        $pet = Pet::where('idpemilik', $pemilik->idpemilik)
            ->where('idpet', $petId)
            ->firstOrFail();

        $rekamMedis = RekamMedis::where('idpet', $petId)
            ->with([
                'pet.rasHewan.jenisHewan',
                'dokterPemeriksa.user',
                'detailRekamMedis.kodeTindakanTerapi'
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pemilik.rekam-medis.by-pet', compact('rekamMedis', 'pet'));
    }
}