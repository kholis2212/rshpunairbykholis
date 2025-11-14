<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
    /**
     * Menampilkan daftar kategori klinis menggunakan Query Builder
     */
    public function index()
    {
        $kategoriKlinis = DB::table('kategori_klinis')
                           ->orderBy('nama_kategori_klinis', 'asc')
                           ->get();
        
        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.kategori-klinis.create');
    }

    /**
     * Menyimpan data kategori klinis menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategoriKlinis($request);
        
        // Format nama kategori klinis
        $namaKategoriKlinis = $this->formatNamaKategoriKlinis($validatedData['nama_kategori_klinis']);
        
        // Query Builder: Insert data ke table kategori_klinis TANPA timestamp
        DB::table('kategori_klinis')->insert([
            'nama_kategori_klinis' => $namaKategoriKlinis
            // Hapus created_at dan updated_at karena kolom tidak ada di database
        ]);
        
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Data kategori klinis berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $kategoriKlinis = DB::table('kategori_klinis')
                           ->where('idkategori_klinis', $id)
                           ->first();
        
        if (!$kategoriKlinis) {
            return redirect()->route('admin.kategori-klinis.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    /**
     * Update data kategori klinis menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Cek apakah nama sudah ada (kecuali untuk ID yang sedang diedit)
        $exists = DB::table('kategori_klinis')
                   ->where('nama_kategori_klinis', $request->nama_kategori_klinis)
                   ->where('idkategori_klinis', '!=', $id)
                   ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_kategori_klinis' => 'Nama kategori klinis sudah ada dalam database!'])
                           ->withInput();
        }
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi!',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks!',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter!',
        ]);
        
        // Format nama kategori klinis
        $namaKategoriKlinis = $this->formatNamaKategoriKlinis($validatedData['nama_kategori_klinis']);
        
        // Query Builder: Update data TANPA updated_at
        DB::table('kategori_klinis')
          ->where('idkategori_klinis', $id)
          ->update([
              'nama_kategori_klinis' => $namaKategoriKlinis
              // Hapus updated_at karena kolom tidak ada di database
          ]);
        
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Data kategori klinis berhasil diperbarui!');
    }

    /**
     * Hapus data kategori klinis menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('kategori_klinis')
                        ->where('idkategori_klinis', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.kategori-klinis.index')
                                ->with('success', 'Data kategori klinis berhasil dihapus!');
            } else {
                return redirect()->route('admin.kategori-klinis.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.kategori-klinis.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data kategori klinis
     */
    private function validateKategoriKlinis(Request $request)
    {
        // Cek apakah nama sudah ada
        $exists = DB::table('kategori_klinis')
                   ->where('nama_kategori_klinis', $request->nama_kategori_klinis)
                   ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_kategori_klinis' => 'Nama kategori klinis sudah ada dalam database!'])
                           ->withInput();
        }
        
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi!',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks!',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter!',
        ]);
    }

    /**
     * Helper: Format nama kategori klinis (huruf pertama kapital)
     */
    private function formatNamaKategoriKlinis(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total kategori klinis
    public function countKategoriKlinis()
    {
        $count = DB::table('kategori_klinis')->count();
        return $count;
    }
    
    // 2. Cari kategori klinis berdasarkan keyword
    public function searchKategoriKlinis($keyword)
    {
        $results = DB::table('kategori_klinis')
                    ->where('nama_kategori_klinis', 'like', '%' . $keyword . '%')
                    ->get();
        return $results;
    }
    
    // 3. Ambil 5 kategori klinis terbaru (tanpa created_at, gunakan ID sebagai referensi)
    public function getLatestKategoriKlinis()
    {
        $latest = DB::table('kategori_klinis')
                   ->orderBy('idkategori_klinis', 'desc')
                   ->limit(5)
                   ->get();
        return $latest;
    }
    
    // 4. Join dengan table tindakan
    public function getKategoriKlinisWithTindakan()
    {
        $data = DB::table('kategori_klinis')
                 ->leftJoin('tindakan', 'kategori_klinis.idkategori_klinis', '=', 'tindakan.idkategori_klinis')
                 ->select('kategori_klinis.nama_kategori_klinis', DB::raw('COUNT(tindakan.idtindakan) as total_tindakan'))
                 ->groupBy('kategori_klinis.idkategori_klinis', 'kategori_klinis.nama_kategori_klinis')
                 ->get();
        return $data;
    }
}