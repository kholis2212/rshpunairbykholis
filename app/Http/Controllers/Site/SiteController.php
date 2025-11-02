<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    // Halaman beranda
    public function beranda()
    {
        return view('site.beranda'); // Pastikan ada file resources/views/site/home.blade.php
    }

    // Halaman layanan umum
    public function layanan()
    {
        return view('site.layananumum'); // resources/views/site/layanan.blade.php
    }

    // Halaman struktur organisasi
    public function struktur()
    {
        return view('site.strukturorganisasi'); // resources/views/site/struktur.blade.php
    }

    // Halaman visi, misi, dan tujuan
    public function visimisi()
    {
        return view('site.visimisidantujuan'); // resources/views/site/visimisi.blade.php
    }

    // Halaman login
    public function login()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    // Cek Koneksi
    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return response()->json(['status' => 'success', 'message' => 'Koneksi database berhasil.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Koneksi database gagal: ' . $e->getMessage()]);
        }
    }
}
