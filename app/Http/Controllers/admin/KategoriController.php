<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori menggunakan Query Builder
     */
    public function index()
    {
        $kategori = DB::table('kategori')
                     ->orderBy('nama_kategori', 'asc')
                     ->get();
        
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Menyimpan data kategori menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategori($request);
        
        // Format nama kategori
        $namaKategori = $this->formatNamaKategori($validatedData['nama_kategori']);
        
        // Query Builder: Insert data ke table kategori TANPA timestamp
        DB::table('kategori')->insert([
            'nama_kategori' => $namaKategori
            // Hapus created_at dan updated_at karena kolom tidak ada di database
        ]);
        
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Data kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $kategori = DB::table('kategori')
                     ->where('idkategori', $id)
                     ->first();
        
        if (!$kategori) {
            return redirect()->route('admin.kategori.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update data kategori menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Cek apakah nama sudah ada (kecuali untuk ID yang sedang diedit)
        $exists = DB::table('kategori')
                   ->where('nama_kategori', $request->nama_kategori)
                   ->where('idkategori', '!=', $id)
                   ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_kategori' => 'Nama kategori sudah ada dalam database!'])
                           ->withInput();
        }
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.string' => 'Nama kategori harus berupa teks!',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter!',
        ]);
        
        // Format nama kategori
        $namaKategori = $this->formatNamaKategori($validatedData['nama_kategori']);
        
        // Query Builder: Update data TANPA updated_at
        DB::table('kategori')
          ->where('idkategori', $id)
          ->update([
              'nama_kategori' => $namaKategori
              // Hapus updated_at karena kolom tidak ada di database
          ]);
        
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Data kategori berhasil diperbarui!');
    }

    /**
     * Hapus data kategori menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('kategori')
                        ->where('idkategori', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.kategori.index')
                                ->with('success', 'Data kategori berhasil dihapus!');
            } else {
                return redirect()->route('admin.kategori.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data kategori
     */
    private function validateKategori(Request $request)
    {
        // Cek apakah nama sudah ada
        $exists = DB::table('kategori')
                   ->where('nama_kategori', $request->nama_kategori)
                   ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_kategori' => 'Nama kategori sudah ada dalam database!'])
                           ->withInput();
        }
        
        return $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.string' => 'Nama kategori harus berupa teks!',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter!',
        ]);
    }

    /**
     * Helper: Format nama kategori (huruf pertama kapital)
     */
    private function formatNamaKategori(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total kategori
    public function countKategori()
    {
        $count = DB::table('kategori')->count();
        return $count;
    }
    
    // 2. Cari kategori berdasarkan keyword
    public function searchKategori($keyword)
    {
        $results = DB::table('kategori')
                    ->where('nama_kategori', 'like', '%' . $keyword . '%')
                    ->get();
        return $results;
    }
    
    // 3. Ambil 5 kategori terbaru (tanpa created_at, gunakan ID sebagai referensi)
    public function getLatestKategori()
    {
        $latest = DB::table('kategori')
                   ->orderBy('idkategori', 'desc')
                   ->limit(5)
                   ->get();
        return $latest;
    }
    
    // 4. Join dengan table layanan
    public function getKategoriWithLayanan()
    {
        $data = DB::table('kategori')
                 ->leftJoin('layanan', 'kategori.idkategori', '=', 'layanan.idkategori')
                 ->select('kategori.nama_kategori', DB::raw('COUNT(layanan.idlayanan) as total_layanan'))
                 ->groupBy('kategori.idkategori', 'kategori.nama_kategori')
                 ->get();
        return $data;
    }
}