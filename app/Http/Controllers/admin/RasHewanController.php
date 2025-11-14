<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasHewanController extends Controller
{
    /**
     * Menampilkan daftar ras hewan menggunakan Query Builder
     */
    public function index()
    {
        $rasHewan = DB::table('ras_hewan')
                    ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                    ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
                    ->orderBy('ras_hewan.nama_ras', 'asc')
                    ->get();
        
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $jenisHewan = DB::table('jenis_hewan')
                       ->orderBy('nama_jenis_hewan', 'asc')
                       ->get();
        
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    /**
     * Menyimpan data ras hewan menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateRasHewan($request);
        
        // Format nama ras hewan
        $namaRas = $this->formatNamaRas($validatedData['nama_ras']);
        
        // Query Builder: Insert data TANPA timestamp
        DB::table('ras_hewan')->insert([
            'nama_ras' => $namaRas,
            'idjenis_hewan' => $validatedData['idjenis_hewan']
            // Hapus created_at dan updated_at karena kolom tidak ada di database
        ]);
        
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Data ras hewan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $rasHewan = DB::table('ras_hewan')
                     ->where('idras_hewan', $id)
                     ->first();
        
        if (!$rasHewan) {
            return redirect()->route('admin.ras-hewan.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        $jenisHewan = DB::table('jenis_hewan')
                       ->orderBy('nama_jenis_hewan', 'asc')
                       ->get();
        
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    /**
     * Update data ras hewan menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Cek apakah nama sudah ada (kecuali untuk ID yang sedang diedit)
        $exists = DB::table('ras_hewan')
                    ->where('nama_ras', $request->nama_ras)
                    ->where('idras_hewan', '!=', $id)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_ras' => 'Nama ras hewan sudah ada dalam database!'])
                           ->withInput();
        }
        
        // Validasi input
        $validatedData = $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi!',
            'nama_ras.string' => 'Nama ras hewan harus berupa teks!',
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter!',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih!',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid!',
        ]);
        
        // Format nama ras hewan
        $namaRas = $this->formatNamaRas($validatedData['nama_ras']);
        
        // Query Builder: Update data TANPA updated_at
        DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->update([
                'nama_ras' => $namaRas,
                'idjenis_hewan' => $validatedData['idjenis_hewan']
                // Hapus updated_at karena kolom tidak ada di database
            ]);
        
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Data ras hewan berhasil diperbarui!');
    }

    /**
     * Hapus data ras hewan menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            // Query Builder: Delete data
            $deleted = DB::table('ras_hewan')
                        ->where('idras_hewan', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.ras-hewan.index')
                                ->with('success', 'Data ras hewan berhasil dihapus!');
            } else {
                return redirect()->route('admin.ras-hewan.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.ras-hewan.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data ras hewan
     */
    private function validateRasHewan(Request $request)
    {
        // Cek apakah nama sudah ada
        $exists = DB::table('ras_hewan')
                    ->where('nama_ras', $request->nama_ras)
                    ->exists();
        
        if ($exists) {
            return redirect()->back()
                           ->withErrors(['nama_ras' => 'Nama ras hewan sudah ada dalam database!'])
                           ->withInput();
        }
        
        return $request->validate([
            'nama_ras' => 'required|string|max:255',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi!',
            'nama_ras.string' => 'Nama ras hewan harus berupa teks!',
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter!',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih!',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid!',
        ]);
    }

    /**
     * Helper: Format nama ras (huruf pertama kapital)
     */
    private function formatNamaRas(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total ras hewan
    public function countRasHewan()
    {
        $count = DB::table('ras_hewan')->count();
        return $count;
    }
    
    // 2. Cari ras hewan berdasarkan keyword
    public function searchRasHewan($keyword)
    {
        $results = DB::table('ras_hewan')
                     ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                     ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
                     ->where('ras_hewan.nama_ras', 'like', '%' . $keyword . '%')
                     ->orWhere('jenis_hewan.nama_jenis_hewan', 'like', '%' . $keyword . '%')
                     ->get();
        return $results;
    }
    
    // 3. Ambil 5 ras hewan terbaru (tanpa created_at, gunakan ID sebagai referensi)
    public function getLatestRasHewan()
    {
        $latest = DB::table('ras_hewan')
                    ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                    ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
                    ->orderBy('ras_hewan.idras_hewan', 'desc') // Ganti created_at dengan idras_hewan
                    ->limit(5)
                    ->get();
        return $latest;
    }
}