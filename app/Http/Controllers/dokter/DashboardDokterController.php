<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Dokter lihat data pet (untuk diagnosis)
        $pet = Pet::with('pemilik.user', 'rasHewan')->get();
        return view('dashboard.dokter', compact('pet'));
    }
}