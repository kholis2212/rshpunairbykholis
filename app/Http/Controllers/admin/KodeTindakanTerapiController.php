<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    /**
     * Menampilkan daftar kode tindakan terapi
     */
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    /**
     * Menyimpan data kode tindakan terapi
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateKodeTindakanTerapi($request);
        
        // Format data
        $validatedData['kode'] = strtoupper($validatedData['kode']);
        $validatedData['deskripsi_tindakan_terapi'] = ucfirst($validatedData['deskripsi_tindakan_terapi']);
        
        // Simpan data
        KodeTindakanTerapi::create($validatedData);
        
        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Data kode tindakan terapi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    /**
     * Update data kode tindakan terapi
     */
    public function update(Request $request, $id)
    {
        // Validasi input, kecuali ID yang sedang diedit
        $validatedData = $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ], [
            'kode.required' => 'Kode wajib diisi!',
            'kode.max' => 'Kode maksimal 5 karakter!',
            'kode.unique' => 'Kode sudah ada dalam database!',
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
        
        // Update data
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->update($validatedData);
        
        return redirect()->route('admin.kode-tindakan-terapi.index')
                        ->with('success', 'Data kode tindakan terapi berhasil diperbarui!');
    }

    /**
     * Hapus data kode tindakan terapi
     */
    public function destroy($id)
    {
        try {
            $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
            $kodeTindakanTerapi->delete();
            
            return redirect()->route('admin.kode-tindakan-terapi.index')
                            ->with('success', 'Data kode tindakan terapi berhasil dihapus!');
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
        return $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ], [
            'kode.required' => 'Kode wajib diisi!',
            'kode.string' => 'Kode harus berupa teks!',
            'kode.max' => 'Kode maksimal 5 karakter!',
            'kode.unique' => 'Kode sudah ada dalam database!',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi tindakan/terapi wajib diisi!',
            'deskripsi_tindakan_terapi.string' => 'Deskripsi harus berupa teks!',
            'deskripsi_tindakan_terapi.max' => 'Deskripsi maksimal 1000 karakter!',
            'idkategori.required' => 'Kategori wajib dipilih!',
            'idkategori.exists' => 'Kategori tidak valid!',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih!',
            'idkategori_klinis.exists' => 'Kategori klinis tidak valid!',
        ]);
    }
}