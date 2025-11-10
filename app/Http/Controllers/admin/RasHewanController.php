<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    /**
     * Menampilkan daftar ras hewan
     */
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $jenisHewan = JenisHewan::all(); // Untuk dropdown jenis hewan
        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    /**
     * Menyimpan data ras hewan
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateRasHewan($request);
        
        // Format nama ras hewan
        $validatedData['nama_ras'] = $this->formatNamaRas($validatedData['nama_ras']);
        
        // Simpan data
        RasHewan::create($validatedData);
        
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Data ras hewan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();
        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    /**
     * Update data ras hewan
     */
    public function update(Request $request, $id)
    {
        // Validasi input, kecuali ID yang sedang diedit
        $validatedData = $request->validate([
            'nama_ras' => 'required|string|max:255|unique:ras_hewan,nama_ras,' . $id . ',idras_hewan',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi!',
            'nama_ras.string' => 'Nama ras hewan harus berupa teks!',
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter!',
            'nama_ras.unique' => 'Nama ras hewan sudah ada dalam database!',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih!',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid!',
        ]);
        
        // Format nama ras hewan
        $validatedData['nama_ras'] = $this->formatNamaRas($validatedData['nama_ras']);
        
        // Update data
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->update($validatedData);
        
        return redirect()->route('admin.ras-hewan.index')
                        ->with('success', 'Data ras hewan berhasil diperbarui!');
    }

    /**
     * Hapus data ras hewan
     */
    public function destroy($id)
    {
        try {
            $rasHewan = RasHewan::findOrFail($id);
            $rasHewan->delete();
            
            return redirect()->route('admin.ras-hewan.index')
                            ->with('success', 'Data ras hewan berhasil dihapus!');
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
        return $request->validate([
            'nama_ras' => 'required|string|max:255|unique:ras_hewan,nama_ras',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ], [
            'nama_ras.required' => 'Nama ras hewan wajib diisi!',
            'nama_ras.string' => 'Nama ras hewan harus berupa teks!',
            'nama_ras.max' => 'Nama ras hewan maksimal 255 karakter!',
            'nama_ras.unique' => 'Nama ras hewan sudah ada dalam database!',
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
}