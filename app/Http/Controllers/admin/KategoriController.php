<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Menampilkan daftar kategori
     */
    public function index()
    {
        $kategori = Kategori::all();
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
     * Menyimpan data kategori
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKategori($request);
        
        // Format nama kategori
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);
        
        // Simpan data
        Kategori::create($validatedData);
        
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Data kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update data kategori
     */
    public function update(Request $request, $id)
    {
        // Validasi input, kecuali ID yang sedang diedit
        $validatedData = $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id . ',idkategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.string' => 'Nama kategori harus berupa teks!',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter!',
            'nama_kategori.unique' => 'Nama kategori sudah ada dalam database!',
        ]);
        
        // Format nama kategori
        $validatedData['nama_kategori'] = $this->formatNamaKategori($validatedData['nama_kategori']);
        
        // Update data
        $kategori = Kategori::findOrFail($id);
        $kategori->update($validatedData);
        
        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Data kategori berhasil diperbarui!');
    }

    /**
     * Hapus data kategori
     */
    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            
            return redirect()->route('admin.kategori.index')
                            ->with('success', 'Data kategori berhasil dihapus!');
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
        return $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi!',
            'nama_kategori.string' => 'Nama kategori harus berupa teks!',
            'nama_kategori.max' => 'Nama kategori maksimal 255 karakter!',
            'nama_kategori.unique' => 'Nama kategori sudah ada dalam database!',
        ]);
    }

    /**
     * Helper: Format nama kategori (huruf pertama kapital)
     */
    private function formatNamaKategori(string $nama)
    {
        return ucwords(strtolower($nama));
    }
}