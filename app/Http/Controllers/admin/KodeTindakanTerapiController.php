<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KodeTindakanTerapiController extends Controller
{
    /**
     * Menampilkan daftar kode tindakan terapi menggunakan Query Builder
     */
    public function index()
    {
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')
            ->leftJoin('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->orderBy('kode_tindakan_terapi.kode', 'asc')
            ->get();
        
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->orderBy('nama_kategori_klinis', 'asc')->get();
        
        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    /**
     * Menyimpan data kode tindakan terapi menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKodeTindakanTerapi($request);
        
        // Format data
        $validatedData['kode'] = strtoupper($validatedData['kode']);
        $validatedData['deskripsi_tindakan_terapi'] = ucfirst($validatedData['deskripsi_tindakan_terapi']);
        
        // Query Builder: Insert data ke table kode_tindakan_terapi TANPA timestamp
        DB::table('kode_tindakan_terapi')->insert([
            'kode' => $validatedData['kode'],
            'deskripsi_tindakan_terapi' => $validatedData['deskripsi_tindakan_terapi'],
            'idkategori' => $validatedData['idkategori'],
            'idkategori_klinis' => $validatedData['idkategori_klinis']
            // Hapus created_at dan updated_at karena kolom tidak ada di database
        ]);
        
        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Data kode tindakan terapi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')
            ->leftJoin('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->where('kode_tindakan_terapi.idkode_tindakan_terapi', $id)
            ->first();
        
        if (!$kodeTindakanTerapi) {
            return redirect()->route('admin.kode-tindakan-terapi.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->orderBy('nama_kategori_klinis', 'asc')->get();
        
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    /**
     * Update data kode tindakan terapi menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Cek apakah kode sudah ada (kecuali untuk ID yang sedang diedit)
        $exists = DB::table('kode_tindakan_terapi')
                    ->where('kode', $request->kode)
                    ->where('idkode_tindakan_terapi', '!=', $id)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['kode' => 'Kode sudah ada dalam database!'])
                           ->withInput();
        }
        
        // Validasi input
        $validatedData = $request->validate([
            'kode' => 'required|string|max:5',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ], [
            'kode.required' => 'Kode wajib diisi!',
            'kode.max' => 'Kode maksimal 5 karakter!',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi!',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 1000 karakter!',
            'idkategori.required' => 'Kategori wajib dipilih!',
            'idkategori.exists' => 'Kategori tidak valid!',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih!',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid!',
        ]);
        
        // Format data
        $validatedData['kode'] = strtoupper($validatedData['kode']);
        $validatedData['deskripsi_tindakan_terapi'] = ucfirst($validatedData['deskripsi_tindakan_terapi']);
        
        // Query Builder: Update data TANPA updated_at
        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                'kode' => $validatedData['kode'],
                'deskripsi_tindakan_terapi' => $validatedData['deskripsi_tindakan_terapi'],
                'idkategori' => $validatedData['idkategori'],
                'idkategori_klinis' => $validatedData['idkategori_klinis']
                // Hapus updated_at karena kolom tidak ada di database
            ]);
        
        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Data kode tindakan terapi berhasil diperbarui!');
    }

    /**
     * Hapus data kode tindakan terapi menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('kode_tindakan_terapi')
                        ->where('idkode_tindakan_terapi', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.kode-tindakan-terapi.index')
                                ->with('success', 'Data kode tindakan terapi berhasil dihapus!');
            } else {
                return redirect()->route('admin.kode-tindakan-terapi.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.kode-tindakan-terapi.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data kode tindakan terapi
     */
    private function validateKodeTindakanTerapi(Request $request)
    {
        // Cek apakah kode sudah ada
        $exists = DB::table('kode_tindakan_terapi')
                    ->where('kode', $request->kode)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['kode' => 'Kode sudah ada dalam database!'])
                           ->withInput();
        }
        
        return $request->validate([
            'kode' => 'required|string|max:5',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ], [
            'kode.required' => 'Kode wajib diisi!',
            'kode.string' => 'Kode harus berupa teks!',
            'kode.max' => 'Kode maksimal 5 karakter!',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi tindakan/terapi wajib diisi!',
            'deskripsi_tindakan_terapi.string' => 'Deskripsi harus berupa teks!',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 1000 karakter!',
            'idkategori.required' => 'Kategori wajib dipilih!',
            'idkategori.exists' => 'Kategori tidak valid!',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih!',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid!',
        ]);
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total kode tindakan terapi
    public function countKodeTindakanTerapi()
    {
        $count = DB::table('kode_tindakan_terapi')->count();
        return $count;
    }
    
    // 2. Cari kode tindakan terapi berdasarkan keyword
    public function searchKodeTindakanTerapi($keyword)
    {
        $results = DB::table('kode_tindakan_terapi')
            ->leftJoin('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->where('kode_tindakan_terapi.kode', 'like', '%' . $keyword . '%')
            ->orWhere('kode_tindakan_terapi.deskripsi_tindakan_terapi', 'like', '%' . $keyword . '%')
            ->orWhere('kategori.nama_kategori', 'like', '%' . $keyword . '%')
            ->orWhere('kategori_klinis.nama_kategori_klinis', 'like', '%' . $keyword . '%')
            ->get();
        return $results;
    }
    
    // 3. Ambil 5 kode tindakan terapi terbaru (tanpa created_at, gunakan ID sebagai referensi)
    public function getLatestKodeTindakanTerapi()
    {
        $latest = DB::table('kode_tindakan_terapi')
            ->leftJoin('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->leftJoin('kategori_klinis', 'kode_tindakan_terapi.idkategori_klinis', '=', 'kategori_klinis.idkategori_klinis')
            ->select(
                'kode_tindakan_terapi.*',
                'kategori.nama_kategori',
                'kategori_klinis.nama_kategori_klinis'
            )
            ->orderBy('kode_tindakan_terapi.idkode_tindakan_terapi', 'desc')
            ->limit(5)
            ->get();
        return $latest;
    }
    
    // 4. Group by kategori
    public function getKodeTindakanTerapiByKategori()
    {
        $data = DB::table('kode_tindakan_terapi')
            ->leftJoin('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
            ->select('kategori.nama_kategori', DB::raw('COUNT(kode_tindakan_terapi.idkode_tindakan_terapi) as total_kode'))
            ->groupBy('kategori.idkategori', 'kategori.nama_kategori')
            ->get();
        return $data;
    }
}