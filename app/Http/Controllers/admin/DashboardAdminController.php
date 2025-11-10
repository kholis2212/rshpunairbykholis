<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use App\Models\RasHewan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Ambil semua data master untuk admin (dari Modul 9)
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        $kodeTindakanTerapi = KodeTindakanTerapi::with('kategori', 'kategoriKlinis')->get();
        $role = Role::all();
        $userRole = User::with('roleUsers.role')->get();

        return view('admin.dashboard-admin', compact('jenisHewan', 'rasHewan', 'kategori', 'kategoriKlinis', 'kodeTindakanTerapi', 'role', 'userRole'));
    }
}