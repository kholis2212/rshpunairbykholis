<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
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
        return view('perawat.dashboard-perawat', compact('pet', 'kodeTindakanTerapi'));
    }
}