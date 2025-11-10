<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    /**
     * Menampilkan daftar kategori klinis
     */
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
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
     * Menyimpan data kategori klinis
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategoriKlinis($request);
        
        // Format nama kategori klinis
        $validatedData['nama_kategori_klinis'] = $this->formatNamaKategoriKlinis($validatedData['nama_kategori_klinis']);
        
        // Simpan data
        KategoriKlinis::create($validatedData);
        
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Data kategori klinis berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('admin.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    /**
     * Update data kategori klinis
     */
    public function update(Request $request, $id)
    {
        // Validasi input, kecuali ID yang sedang diedit
        $validatedData = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255|unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi!',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks!',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter!',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada dalam database!',
        ]);
        
        // Format nama kategori klinis
        $validatedData['nama_kategori_klinis'] = $this->formatNamaKategoriKlinis($validatedData['nama_kategori_klinis']);
        
        // Update data
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        $kategoriKlinis->update($validatedData);
        
        return redirect()->route('admin.kategori-klinis.index')
                        ->with('success', 'Data kategori klinis berhasil diperbarui!');
    }

    /**
     * Hapus data kategori klinis
     */
    public function destroy($id)
    {
        try {
            $kategoriKlinis = KategoriKlinis::findOrFail($id);
            $kategoriKlinis->delete();
            
            return redirect()->route('admin.kategori-klinis.index')
                            ->with('success', 'Data kategori klinis berhasil dihapus!');
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
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:255|unique:kategori_klinis,nama_kategori_klinis',
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi!',
            'nama_kategori_klinis.string' => 'Nama kategori klinis harus berupa teks!',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 255 karakter!',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada dalam database!',
        ]);
    }

    /**
     * Helper: Format nama kategori klinis (huruf pertama kapital)
     */
    private function formatNamaKategoriKlinis(string $nama)
    {
        return ucwords(strtolower($nama));
    }
}