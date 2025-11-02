<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all(); // Mengambil semua data kategori klinis
        return view('admin.kategoriklinis.index', compact('kategoriKlinis'));
    }
}