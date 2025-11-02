<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Perawat lihat data pet dan kode tindakan
        $pet = Pet::with('pemilik.user', 'rasHewan')->get();
        $kodeTindakanTerapi = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        return view('dashboard.perawat', compact('pet', 'kodeTindakanTerapi'));
    }
}