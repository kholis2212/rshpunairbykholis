<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    /**
     * Menampilkan daftar pet menggunakan Query Builder
     */
    public function index()
    {
        $pet = DB::table('pet')
                ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->select(
                    'pet.*',
                    'user.nama as nama_pemilik',
                    'ras_hewan.nama_ras',
                    'jenis_hewan.nama_jenis_hewan'
                )
                ->orderBy('pet.nama', 'asc')
                ->get();
        
        return view('admin.pet.index', compact('pet'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $pemilik = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.idpemilik', 'user.nama', 'pemilik.no_wa')
                    ->get();
        
        $rasHewan = DB::table('ras_hewan')
                     ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                     ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
                     ->get();
        
        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    /**
     * Menyimpan data pet baru menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validatePet($request);
        
        // Format data
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        $validatedData['warna_tanda'] = ucfirst($validatedData['warna_tanda']);
        
        // Query Builder: Insert data ke table pet
        DB::table('pet')->insert([
            'nama' => $validatedData['nama'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'warna_tanda' => $validatedData['warna_tanda'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'idpemilik' => $validatedData['idpemilik'],
            'idras_hewan' => $validatedData['idras_hewan']
        ]);
        
        return redirect()->route('admin.pet.index')
                        ->with('success', 'Data pet berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $pet = DB::table('pet')
                ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                ->select(
                    'pet.*',
                    'user.nama as nama_pemilik',
                    'ras_hewan.nama_ras',
                    'jenis_hewan.nama_jenis_hewan'
                )
                ->where('pet.idpet', $id)
                ->first();
        
        if (!$pet) {
            return redirect()->route('admin.pet.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        $pemilik = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.idpemilik', 'user.nama', 'pemilik.no_wa')
                    ->get();
        
        $rasHewan = DB::table('ras_hewan')
                     ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                     ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
                     ->get();
        
        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    /**
     * Update data pet menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $this->validatePet($request, $id);
        
        // Format data
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        $validatedData['warna_tanda'] = ucfirst($validatedData['warna_tanda']);
        
        // Query Builder: Update data
        DB::table('pet')
            ->where('idpet', $id)
            ->update([
                'nama' => $validatedData['nama'],
                'tanggal_lahir' => $validatedData['tanggal_lahir'],
                'warna_tanda' => $validatedData['warna_tanda'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
                'idpemilik' => $validatedData['idpemilik'],
                'idras_hewan' => $validatedData['idras_hewan']
            ]);
        
        return redirect()->route('admin.pet.index')
                        ->with('success', 'Data pet berhasil diperbarui!');
    }

    /**
     * Hapus data pet menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            $deleted = DB::table('pet')
                        ->where('idpet', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.pet.index')
                                ->with('success', 'Data pet berhasil dihapus!');
            } else {
                return redirect()->route('admin.pet.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.pet.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data pet
     */
    private function validatePet(Request $request, $id = null)
    {
        return $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'warna_tanda' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ], [
            'nama.required' => 'Nama pet wajib diisi!',
            'nama.max' => 'Nama pet maksimal 100 karakter!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'tanggal_lahir.date' => 'Format tanggal tidak valid!',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini!',
            'warna_tanda.required' => 'Warna/tanda wajib diisi!',
            'warna_tanda.max' => 'Warna/tanda maksimal 45 karakter!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid!',
            'idpemilik.required' => 'Pemilik wajib dipilih!',
            'idpemilik.exists' => 'Pemilik tidak valid!',
            'idras_hewan.required' => 'Ras hewan wajib dipilih!',
            'idras_hewan.exists' => 'Ras hewan tidak valid!',
        ]);
    }

    /**
     * Helper: Format nama (huruf pertama kapital)
     */
    private function formatNama(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total pet
    public function countPet()
    {
        $count = DB::table('pet')->count();
        return $count;
    }
    
    // 2. Cari pet berdasarkan keyword
    public function searchPet($keyword)
    {
        $results = DB::table('pet')
                    ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                    ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                    ->where('pet.nama', 'like', '%' . $keyword . '%')
                    ->orWhere('user.nama', 'like', '%' . $keyword . '%')
                    ->orWhere('ras_hewan.nama_ras', 'like', '%' . $keyword . '%')
                    ->select('pet.*', 'user.nama as nama_pemilik', 'ras_hewan.nama_ras')
                    ->get();
        return $results;
    }
    
    // 3. Ambil 5 pet terbaru
    public function getLatestPet()
    {
        $latest = DB::table('pet')
                   ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
                   ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                   ->select('pet.*', 'user.nama as nama_pemilik')
                   ->orderBy('pet.idpet', 'desc')
                   ->limit(5)
                   ->get();
        return $latest;
    }
    
    // 4. Get pet by pemilik
    public function getPetByPemilik($idPemilik)
    {
        $pets = DB::table('pet')
                  ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
                  ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                  ->where('pet.idpemilik', $idPemilik)
                  ->select('pet.*', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
                  ->get();
        return $pets;
    }
}