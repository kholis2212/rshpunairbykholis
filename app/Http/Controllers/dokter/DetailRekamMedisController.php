<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DetailRekamMedisController extends Controller
{
    public function show($id)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'pet.jenis_kelamin as jenis_kelamin_pet',
                'pet.tanggal_lahir',
                'pemilik.nama as nama_pemilik',
                'jenis_hewan.nama as jenis_hewan',
                'ras_hewan.nama as ras_hewan',
                'dokter.alamat as alamat_dokter',
                'dokter.bidang_dokter',
                'user_dokter.nama as nama_dokter'
            )
            ->leftJoin('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->leftJoin('dokter', 'rekam_medis.dokter_pemeriksa', '=', 'dokter.iduser')
            ->leftJoin('user as user_dokter', 'dokter.iduser', '=', 'user_dokter.iduser')
            ->where('rekam_medis.idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('dokter.rekam-medis.index')
                           ->with('error', 'Data rekam medis tidak ditemukan!');
        }

        // Get tindakan terapi
        $tindakanTerapi = DB::table('tindakan_terapi')
            ->where('idrekam_medis', $id)
            ->get();

        $rekamMedis->tindakan_terapi = $tindakanTerapi;

        return view('dokter.detail-rekam-medis.show', compact('rekamMedis'));
    }

    public function create()
    {
        // Get all pets for dropdown
        $pets = DB::table('pet')
            ->select(
                'pet.idpet',
                'pet.nama',
                'pemilik.nama as nama_pemilik',
                'jenis_hewan.nama as jenis_hewan'
            )
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->orderBy('pet.nama', 'asc')
            ->get();

        return view('dokter.detail-rekam-medis.create', compact('pets'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input
        $validatedData = $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'required|string|max:1000',
            'tindakan_nama' => 'nullable|array',
            'tindakan_biaya' => 'nullable|array',
            'tindakan_deskripsi' => 'nullable|array',
        ], [
            'idpet.required' => 'Pilih pasien terlebih dahulu!',
            'idpet.exists' => 'Pasien tidak valid!',
            'diagnosa.required' => 'Diagnosa wajib diisi!',
            'diagnosa.max' => 'Diagnosa maksimal 1000 karakter!',
            'anamnesa.max' => 'Anamnesa maksimal 1000 karakter!',
            'temuan_klinis.max' => 'Temuan klinis maksimal 1000 karakter!',
        ]);

        // Query Builder: Insert data rekam medis
        $idrekam_medis = DB::table('rekam_medis')->insertGetId([
            'idpet' => $validatedData['idpet'],
            'anamnesa' => $validatedData['anamnesa'],
            'temuan_klinis' => $validatedData['temuan_klinis'],
            'diagnosa' => $validatedData['diagnosa'],
            'dokter_pemeriksa' => $user->iduser,
            'created_at' => now(),
        ]);

        // Create tindakan terapi jika ada
        if ($request->tindakan_nama) {
            foreach ($request->tindakan_nama as $index => $nama) {
                if (!empty($nama)) {
                    DB::table('tindakan_terapi')->insert([
                        'idrekam_medis' => $idrekam_medis,
                        'nama_tindakan' => $nama,
                        'biaya' => $request->tindakan_biaya[$index] ?? 0,
                        'deskripsi' => $request->tindakan_deskripsi[$index] ?? null,
                    ]);
                }
            }
        }

        return redirect()->route('dokter.rekam-medis.detail.show', $idrekam_medis)
                         ->with('success', 'Rekam medis berhasil dibuat!');
    }

    public function edit($id)
    {
        $rekamMedis = DB::table('rekam_medis')
            ->select(
                'rekam_medis.*',
                'pet.nama as nama_pet',
                'pemilik.nama as nama_pemilik',
                'jenis_hewan.nama as jenis_hewan',
                'ras_hewan.nama as ras_hewan'
            )
            ->leftJoin('pet', 'rekam_medis.idpet', '=', 'pet.idpet')
            ->leftJoin('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->leftJoin('jenis_hewan', 'pet.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->leftJoin('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->where('rekam_medis.idrekam_medis', $id)
            ->first();

        if (!$rekamMedis) {
            return redirect()->route('dokter.rekam-medis.index')
                           ->with('error', 'Data rekam medis tidak ditemukan!');
        }

        // Get tindakan terapi
        $tindakanTerapi = DB::table('tindakan_terapi')
            ->where('idrekam_medis', $id)
            ->get();

        $rekamMedis->tindakan_terapi = $tindakanTerapi;

        return view('dokter.detail-rekam-medis.edit', compact('rekamMedis'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'anamnesa' => 'nullable|string|max:1000',
            'temuan_klinis' => 'nullable|string|max:1000',
            'diagnosa' => 'required|string|max:1000',
            'tindakan_nama' => 'nullable|array',
            'tindakan_biaya' => 'nullable|array',
            'tindakan_deskripsi' => 'nullable|array',
            'tindakan_id' => 'nullable|array',
        ], [
            'diagnosa.required' => 'Diagnosa wajib diisi!',
            'diagnosa.max' => 'Diagnosa maksimal 1000 karakter!',
            'anamnesa.max' => 'Anamnesa maksimal 1000 karakter!',
            'temuan_klinis.max' => 'Temuan klinis maksimal 1000 karakter!',
        ]);

        // Query Builder: Update rekam medis
        DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->update([
                'anamnesa' => $validatedData['anamnesa'],
                'temuan_klinis' => $validatedData['temuan_klinis'],
                'diagnosa' => $validatedData['diagnosa'],
            ]);

        // Update atau create tindakan terapi
        if ($request->tindakan_nama) {
            foreach ($request->tindakan_nama as $index => $nama) {
                if (!empty($nama)) {
                    $tindakanId = $request->tindakan_id[$index] ?? null;
                    
                    if ($tindakanId) {
                        // Update existing tindakan
                        DB::table('tindakan_terapi')
                            ->where('id', $tindakanId)
                            ->where('idrekam_medis', $id)
                            ->update([
                                'nama_tindakan' => $nama,
                                'biaya' => $request->tindakan_biaya[$index] ?? 0,
                                'deskripsi' => $request->tindakan_deskripsi[$index] ?? null,
                            ]);
                    } else {
                        // Create new tindakan
                        DB::table('tindakan_terapi')->insert([
                            'idrekam_medis' => $id,
                            'nama_tindakan' => $nama,
                            'biaya' => $request->tindakan_biaya[$index] ?? 0,
                            'deskripsi' => $request->tindakan_deskripsi[$index] ?? null,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('dokter.rekam-medis.detail.show', $id)
                         ->with('success', 'Rekam medis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            // Hapus tindakan terapi terlebih dahulu
            DB::table('tindakan_terapi')
                ->where('idrekam_medis', $id)
                ->delete();

            // Hapus rekam medis
            $deleted = DB::table('rekam_medis')
                ->where('idrekam_medis', $id)
                ->delete();
            
            if ($deleted) {
                return redirect()->route('dokter.rekam-medis.index')
                                ->with('success', 'Rekam medis berhasil dihapus!');
            } else {
                return redirect()->route('dokter.rekam-medis.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('dokter.rekam-medis.index')
                            ->with('error', 'Gagal menghapus data!');
        }
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Get rekam medis by pet
    public function getRekamMedisByPet($idpet)
    {
        $user = Auth::user();
        $results = DB::table('rekam_medis')
            ->where('idpet', $idpet)
            ->where('dokter_pemeriksa', $user->iduser)
            ->orderBy('created_at', 'desc')
            ->get();
        return $results;
    }
    
    // 2. Get statistics for chart
    public function getRekamMedisStats($year)
    {
        $user = Auth::user();
        $stats = DB::table('rekam_medis')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->where('dokter_pemeriksa', $user->iduser)
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();
        return $stats;
    }
}