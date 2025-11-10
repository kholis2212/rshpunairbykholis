<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class DashboardDokterController extends Controller
{
    public function index()
    {
        // Dokter lihat data pet (untuk diagnosis)
        $pet = Pet::with('pemilik.user', 'rasHewan')->get();
        return view('dokter.dashboard-dokter', compact('pet'));
    }
}