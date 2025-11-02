<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get(); // Mengambil semua data pemilik dengan relasi user
        return view('pemilik.index', compact('pemilik'));
    }
}