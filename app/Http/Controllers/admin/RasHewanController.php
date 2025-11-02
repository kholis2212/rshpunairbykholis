<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get(); // Mengambil semua data ras hewan dengan relasi jenis hewan
        return view('admin.rashewan.index', compact('rasHewan'));
    }
}