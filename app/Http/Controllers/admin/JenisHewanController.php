<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisHewanController extends Controller
{
    /**
     * Menampilkan daftar jenis hewan menggunakan Query Builder
     */
    public function index()
    {
        $jenisHewan = DB::table('jenis_hewan')
                        ->orderBy('nama_jenis_hewan', 'asc')
                        ->get();
        
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    /**
     * Menyimpan data jenis hewan menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateJenisHewan($request);
        
        // Format nama jenis hewan
        $namaJenisHewan = $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']);
        
        // Query Builder: Insert data ke table jenis_hewan TANPA timestamp
        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $namaJenisHewan
            // Hapus created_at dan updated_at karena kolom tidak ada di database
        ]);
        
        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Data jenis hewan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $jenisHewan = DB::table('jenis_hewan')
                        ->where('idjenis_hewan', $id)
                        ->first();
        
        if (!$jenisHewan) {
            return redirect()->route('admin.jenis-hewan.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    /**
     * Update data jenis hewan menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Cek apakah nama sudah ada (kecuali untuk ID yang sedang diedit)
        $exists = DB::table('jenis_hewan')
                    ->where('nama_jenis_hewan', $request->nama_jenis_hewan)
                    ->where('idjenis_hewan', '!=', $id)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_jenis_hewan' => 'Nama jenis hewan sudah ada dalam database!'])
                           ->withInput();
        }
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi!',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks!',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter!',
        ]);
        
        // Format nama jenis hewan
        $namaJenisHewan = $this->formatNamaJenisHewan($validatedData['nama_jenis_hewan']);
        
        // Query Builder: Update data TANPA updated_at
        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $namaJenisHewan
                // Hapus updated_at karena kolom tidak ada di database
            ]);
        
        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Data jenis hewan berhasil diperbarui!');
    }

    /**
     * Hapus data jenis hewan menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('jenis_hewan')
                        ->where('idjenis_hewan', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.jenis-hewan.index')
                                ->with('success', 'Data jenis hewan berhasil dihapus!');
            } else {
                return redirect()->route('admin.jenis-hewan.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.jenis-hewan.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data jenis hewan
     */
    private function validateJenisHewan(Request $request)
    {
        // Cek apakah nama sudah ada
        $exists = DB::table('jenis_hewan')
                    ->where('nama_jenis_hewan', $request->nama_jenis_hewan)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_jenis_hewan' => 'Nama jenis hewan sudah ada dalam database!'])
                           ->withInput();
        }
        
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:255',
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi!',
            'nama_jenis_hewan.string' => 'Nama jenis hewan harus berupa teks!',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter!',
        ]);
    }

    /**
     * Helper: Format nama jenis hewan (huruf pertama kapital)
     */
    private function formatNamaJenisHewan(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total jenis hewan
    public function countJenisHewan()
    {
        $count = DB::table('jenis_hewan')->count();
        return $count;
    }
    
    // 2. Cari jenis hewan berdasarkan keyword
    public function searchJenisHewan($keyword)
    {
        $results = DB::table('jenis_hewan')
                     ->where('nama_jenis_hewan', 'like', '%' . $keyword . '%')
                     ->get();
        return $results;
    }
    
    // 3. Ambil 5 jenis hewan terbaru (tanpa created_at, gunakan ID sebagai referensi)
    public function getLatestJenisHewan()
    {
        $latest = DB::table('jenis_hewan')
                    ->orderBy('idjenis_hewan', 'desc')
                    ->limit(5)
                    ->get();
        return $latest;
    }
    
    // 4. Join dengan table ras_hewan
    public function getJenisHewanWithRas()
    {
        $data = DB::table('jenis_hewan')
                  ->leftJoin('ras_hewan', 'jenis_hewan.idjenis_hewan', '=', 'ras_hewan.idjenis_hewan')
                  ->select('jenis_hewan.nama_jenis_hewan', DB::raw('COUNT(ras_hewan.idras_hewan) as total_ras'))
                  ->groupBy('jenis_hewan.idjenis_hewan', 'jenis_hewan.nama_jenis_hewan')
                  ->get();
        return $data;
    }
}