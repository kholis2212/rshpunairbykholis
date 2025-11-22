<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\JenisHewan;

class PetPemilikController extends Controller
{
    public function index()
    {
        // Ambil data pemilik berdasarkan user yang login
        $pemilik = Pemilik::where('iduser', Auth::id())->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        // Ambil pets milik pemilik
        $pets = Pet::where('idpemilik', $pemilik->idpemilik)
            ->with(['rasHewan.jenisHewan'])
            ->orderBy('nama', 'asc')
            ->get();

        return view('pemilik.pet.index', compact('pets', 'pemilik'));
    }

    public function show($id)
    {
        $pemilik = Pemilik::where('iduser', Auth::id())->first();
        
        if (!$pemilik) {
            return redirect()->route('login')->with('error', 'Data pemilik tidak ditemukan.');
        }

        $pet = Pet::where('idpemilik', $pemilik->idpemilik)
            ->where('idpet', $id)
            ->with(['rasHewan.jenisHewan'])
            ->firstOrFail();

        return view('pemilik.pet.show', compact('pet'));
    }
}