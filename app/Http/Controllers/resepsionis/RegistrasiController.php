<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik; 
use App\Models\Pet;      

class RegistrasiController extends Controller
{
    public function pemilik()
    {
        // ambil semua data pemilik
        $pemilik = Pemilik::all();

        // kirim ke view
        return view('resepsionis.registrasi.pemilik.index', compact('pemilik'));
    }

    public function pet()
    {
        // ambil semua data hewan
        $pets = Pet::all();

        // kirim ke view
        return view('resepsionis.registrasi.pet.index', compact('pets'));
    }
}
