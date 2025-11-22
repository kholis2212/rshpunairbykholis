<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RoleUser;
use App\Models\User;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TemuDokterController extends Controller
{
    /**
     * Menampilkan daftar temu dokter hari ini
     */
    public function index()
    {
        try {
            $temuDokter = TemuDokter::with([
                'pet.pemilik.user', 
                'pet.rasHewan.jenisHewan',
                'userDokter'
            ])
            ->hariIni()
            ->orderBy('no_urut', 'asc')
            ->orderBy('waktu_daftar', 'asc')
            ->get();

            $statistik = [
                'total' => $temuDokter->count(),
                'aktif' => $temuDokter->where('status', 'A')->count(),
                'selesai' => $temuDokter->where('status', 'S')->count(),
                'cancel' => $temuDokter->where('status', 'C')->count(),
            ];

            return view('resepsionis.temu-dokter.index', compact('temuDokter', 'statistik'));
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memuat data temu dokter: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form tambah temu dokter
     */
    public function create()
    {
        try {
            // Ambil daftar pemilik dengan pet mereka yang aktif
            $pemilik = Pemilik::with([
                'user', 
                'pets' => function($query) {
                    $query->with(['rasHewan.jenisHewan'])->whereHas('pemilik');
                }
            ])->get();

            // Ambil daftar dokter yang aktif
            $dokter = RoleUser::with('user')
                ->where('idrole', 2) // ID role untuk Dokter
                ->where('status', 1)
                ->get();

            $jenisHewan = JenisHewan::all();
            $nextQueueNumber = TemuDokter::getNextQueueNumber();

            return view('resepsionis.temu-dokter.create', compact(
                'pemilik', 
                'dokter', 
                'jenisHewan',
                'nextQueueNumber'
            ));
            
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memuat form: ' . $e->getMessage());
        }
    }

    /**
     * Menyimpan data temu dokter baru
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'keluhan' => 'nullable|string|max:500',
        ], [
            'idpet.required' => 'Pilih hewan peliharaan wajib diisi!',
            'idpet.exists' => 'Hewan peliharaan tidak valid!',
            'idrole_user.required' => 'Pilih dokter wajib diisi!',
            'idrole_user.exists' => 'Dokter tidak valid!',
            'keluhan.max' => 'Keluhan maksimal 500 karakter!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }

        DB::beginTransaction();
        try {
            $nextQueueNumber = TemuDokter::getNextQueueNumber();

            $temuDokter = TemuDokter::create([
                'no_urut' => $nextQueueNumber,
                'waktu_daftar' => now(),
                'status' => 'A', // A = Aktif
                'idpet' => $request->idpet,
                'idrole_user' => $request->idrole_user,
            ]);

            DB::commit();

            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('success', 'Jadwal temu dokter berhasil ditambahkan! Nomor antrian: ' . $nextQueueNumber);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan jadwal temu dokter: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit temu dokter
     */
    public function edit($id)
    {
        try {
            $temuDokter = TemuDokter::with([
                'pet.pemilik.user', 
                'pet.rasHewan.jenisHewan',
                'userDokter'
            ])->findOrFail($id);

            // Ambil daftar pemilik dengan pet mereka
            $pemilik = Pemilik::with([
                'user', 
                'pets' => function($query) {
                    $query->with(['rasHewan.jenisHewan']);
                }
            ])->get();

            // Ambil daftar dokter yang aktif
            $dokter = RoleUser::with('user')
                ->where('idrole', 2)
                ->where('status', 1)
                ->get();

            $jenisHewan = JenisHewan::all();

            return view('resepsionis.temu-dokter.edit', compact(
                'temuDokter', 
                'pemilik', 
                'dokter', 
                'jenisHewan'
            ));
            
        } catch (\Exception $e) {
            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('error', 'Data temu dokter tidak ditemukan!');
        }
    }

    /**
     * Update data temu dokter
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'status' => 'required|in:A,S,C',
            'keluhan' => 'nullable|string|max:500',
        ], [
            'idpet.required' => 'Pilih hewan peliharaan wajib diisi!',
            'idpet.exists' => 'Hewan peliharaan tidak valid!',
            'idrole_user.required' => 'Pilih dokter wajib diisi!',
            'idrole_user.exists' => 'Dokter tidak valid!',
            'status.required' => 'Status wajib dipilih!',
            'status.in' => 'Status tidak valid!',
            'keluhan.max' => 'Keluhan maksimal 500 karakter!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }

        try {
            $temuDokter = TemuDokter::findOrFail($id);

            $temuDokter->update([
                'idpet' => $request->idpet,
                'idrole_user' => $request->idrole_user,
                'status' => $request->status,
            ]);

            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('success', 'Data temu dokter berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui data temu dokter: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data temu dokter
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $temuDokter = TemuDokter::findOrFail($id);
            $nomorAntrian = $temuDokter->no_urut;
            $temuDokter->delete();

            DB::commit();

            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('success', 'Data temu dokter nomor antrian ' . $nomorAntrian . ' berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('resepsionis.temu-dokter.index')
                ->with('error', 'Gagal menghapus data temu dokter: ' . $e->getMessage());
        }
    }

    /**
     * Update status temu dokter
     */
    public function updateStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:A,S,C',
        ], [
            'status.required' => 'Status wajib dipilih!',
            'status.in' => 'Status tidak valid!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $temuDokter = TemuDokter::findOrFail($id);
            $temuDokter->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui!',
                'status_lengkap' => $temuDokter->status_lengkap,
                'warna_status' => $temuDokter->warna_status
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get pets by owner (AJAX)
     */
    public function getPetsByOwner($idPemilik)
    {
        try {
            $pets = Pet::with(['rasHewan.jenisHewan'])
                ->where('idpemilik', $idPemilik)
                ->get()
                ->map(function($pet) {
                    return [
                        'idpet' => $pet->idpet,
                        'nama' => $pet->nama,
                        'jenis_hewan' => $pet->rasHewan->jenisHewan->nama_jenis_hewan,
                        'ras' => $pet->rasHewan->nama_ras,
                        'jenis_kelamin' => $pet->jenis_kelamin,
                        'tanggal_lahir' => $pet->tanggal_lahir,
                    ];
                });

            return response()->json($pets);
            
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Get available doctors (AJAX)
     */
    public function getAvailableDoctors()
    {
        try {
            $doctors = RoleUser::with('user')
                ->where('idrole', 2)
                ->where('status', 1)
                ->get()
                ->map(function($roleUser) {
                    return [
                        'idrole_user' => $roleUser->idrole_user,
                        'nama_dokter' => $roleUser->user->nama,
                        'email' => $roleUser->user->email,
                    ];
                });

            return response()->json($doctors);
            
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }
}