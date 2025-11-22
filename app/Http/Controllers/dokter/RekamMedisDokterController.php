<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekamMedisDokterController extends Controller
{
    /**
     * Menampilkan daftar rekam medis untuk dokter (VIEW ONLY)
     */
    public function index()
    {
        $dokterId = Auth::user()->iduser;
        
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan', 'pet.rasHewan.jenisHewan'])
            ->where('dokter_pemeriksa', $dokterId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    /**
     * Menampilkan detail rekam medis (VIEW ONLY)
     */
    public function show($id)
    {
        $dokterId = Auth::user()->iduser;
        
        $rekamMedis = RekamMedis::with([
            'pet', 
            'pet.pemilik', 
            'pet.rasHewan', 
            'pet.rasHewan.jenisHewan',
            'detailRekamMedis',
            'detailRekamMedis.kodeTindakanTerapi',
            'detailRekamMedis.kodeTindakanTerapi.kategori',
            'detailRekamMedis.kodeTindakanTerapi.kategoriKlinis'
        ])->where('idrekam_medis', $id)
          ->where('dokter_pemeriksa', $dokterId)
          ->firstOrFail();

        return view('dokter.rekam-medis.show', compact('rekamMedis'));
    }

    // ========== METHOD UNTUK DETAIL REKAM MEDIS (CRUD) ==========

    /**
     * Menampilkan form untuk menambah detail rekam medis (tindakan & terapi)
     */
    public function createDetail($id)
    {
        $dokterId = Auth::user()->iduser;
        
        // Pastikan rekam medis milik dokter ini
        $rekamMedis = RekamMedis::with(['pet', 'pet.pemilik', 'pet.rasHewan', 'pet.rasHewan.jenisHewan'])
            ->where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $dokterId)
            ->firstOrFail();

        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('kode', 'asc')
            ->get();

        return view('dokter.rekam-medis.tindakan.create', compact('rekamMedis', 'kodeTindakanTerapi'));
    }

    /**
     * Menyimpan detail rekam medis baru (tindakan & terapi)
     */
    public function storeDetail(Request $request, $id)
    {
        $dokterId = Auth::user()->iduser;
        
        // Validasi bahwa rekam medis milik dokter ini
        $rekamMedis = RekamMedis::where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $dokterId)
            ->firstOrFail();

        $validatedData = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string|max:1000',
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $validatedData['idkode_tindakan_terapi'],
            'detail' => $validatedData['detail'],
        ]);

        return redirect()->route('dokter.rekam-medis.show', $id)
            ->with('success', 'Tindakan & terapi berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit detail rekam medis
     */
    public function editDetail($id, $idDetail)
    {
        $dokterId = Auth::user()->iduser;
        
        // Pastikan rekam medis milik dokter ini
        $rekamMedis = RekamMedis::where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $dokterId)
            ->firstOrFail();

        $detail = DetailRekamMedis::with('kodeTindakanTerapi')
            ->where('iddetail_rekam_medis', $idDetail)
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('kode', 'asc')
            ->get();

        return view('dokter.rekam-medis.tindakan.edit', compact('rekamMedis', 'detail', 'kodeTindakanTerapi'));
    }

    /**
     * Update detail rekam medis
     */
    public function updateDetail(Request $request, $id, $idDetail)
    {
        $dokterId = Auth::user()->iduser;
        
        // Pastikan rekam medis milik dokter ini
        $rekamMedis = RekamMedis::where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $dokterId)
            ->firstOrFail();

        $detail = DetailRekamMedis::where('iddetail_rekam_medis', $idDetail)
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        $validatedData = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'required|string|max:1000',
        ]);

        $detail->update($validatedData);

        return redirect()->route('dokter.rekam-medis.show', $id)
            ->with('success', 'Tindakan & terapi berhasil diperbarui!');
    }

    /**
     * Hapus detail rekam medis
     */
    public function destroyDetail($id, $idDetail)
    {
        $dokterId = Auth::user()->iduser;
        
        // Pastikan rekam medis milik dokter ini
        $rekamMedis = RekamMedis::where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $dokterId)
            ->firstOrFail();

        $detail = DetailRekamMedis::where('iddetail_rekam_medis', $idDetail)
            ->where('idrekam_medis', $id)
            ->firstOrFail();

        $detail->delete();

        return redirect()->route('dokter.rekam-medis.show', $id)
            ->with('success', 'Tindakan & terapi berhasil dihapus!');
    }
}