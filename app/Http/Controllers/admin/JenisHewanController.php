<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all(); // Mengambil semua data jenis hewan
        return view('admin.jenishewan.index', compact('jenisHewan'));
    }
}