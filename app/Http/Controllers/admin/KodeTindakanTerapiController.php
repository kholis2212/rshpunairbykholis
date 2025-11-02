<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get(); // Mengambil semua data kode tindakan terapi dengan relasi
        return view('admin.kodetindakanterapi.index', compact('kodeTindakanTerapi'));
    }
}