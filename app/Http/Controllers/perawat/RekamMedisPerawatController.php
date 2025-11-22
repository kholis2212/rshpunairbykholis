<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Pet;
use App\Models\KodeTindakanTerapi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekamMedisPerawatController extends Controller
{
    /**
     * Menampilkan daftar rekam medis untuk perawat
     */
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan', 'pet.rasHewan.jenisHewan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('perawat.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan form untuk membuat rekam medis baru
     */
    public function create()
    {
        $pets = Pet::with(['pemilik', 'rasHewan', 'rasHewan.jenisHewan'])
            ->orderBy('nama', 'asc')
            ->get();
            
        $dokters = User::whereHas('roleUsers.role', function($query) {
            $query->where('nama_role', 'Dokter');
        })->get();

        return view('perawat.rekam-medis.create', compact('pets', 'dokters'));
    }

    /**
     * Menyimpan rekam medis baru
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
        ]);

        RekamMedis::create($validatedData);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail rekam medis
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet', 
            'pet.pemilik', 
            'pet.rasHewan', 
            'pet.rasHewan.jenisHewan',
            'detailRekamMedis',
            'detailRekamMedis.kodeTindakanTerapi',
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])->findOrFail($id);

        return view('perawat.rekam-medis.detail', compact('rekamMedis'));
    }

    /**
     * Menampilkan form edit rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan'])->findOrFail($id);
        
        $pets = Pet::with(['pemilik', 'rasHewan', 'rasHewan.jenisHewan'])
            ->orderBy('nama', 'asc')
            ->get();
            
        $dokters = User::whereHas('roleUsers.role', function($query) {
            $query->where('nama_role', 'Dokter');
        })->get();

        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'pets', 'dokters'));
    }

    /**
     * Update rekam medis
     */
    public function update(Request $request, $id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);

        $validatedData = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'dokter_pemeriksa' => 'required|exists:role_user,idrole_user',
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'nullable|string|max:1000',
        ]);

        $rekamMedis->update($validatedData);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui!');
    }

    /**
     * Hapus rekam medis
     */
    public function destroy($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id);
        
        // Hapus detail rekam medis terlebih dahulu
        $rekamMedis->detailRekamMedis()->delete();
        $rekamMedis->delete();

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil dihapus!');
    }
}