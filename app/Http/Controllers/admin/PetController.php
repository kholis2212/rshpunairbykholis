<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    /**
     * Menampilkan daftar pet
     */
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->get();
        return view('admin.pet.index', compact('pet'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    /**
     * Menyimpan data pet baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validatePet($request);
        
        // Format data
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        $validatedData['warna_tanda'] = ucfirst($validatedData['warna_tanda']);
        
        // Simpan data
        Pet::create($validatedData);
        
        return redirect()->route('admin.pet.index')
                        ->with('success', 'Data pet berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    /**
     * Update data pet
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $this->validatePet($request, $id);
        
        // Format data
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        $validatedData['warna_tanda'] = ucfirst($validatedData['warna_tanda']);
        
        // Update data
        $pet = Pet::findOrFail($id);
        $pet->update($validatedData);
        
        return redirect()->route('admin.pet.index')
                        ->with('success', 'Data pet berhasil diperbarui!');
    }

    /**
     * Hapus data pet
     */
    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();
            
            return redirect()->route('admin.pet.index')
                            ->with('success', 'Data pet berhasil dihapus!');
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
     * Helper: Hitung umur pet
     */
    public function hitungUmur($tanggalLahir)
    {
        $lahir = new \DateTime($tanggalLahir);
        $sekarang = new \DateTime();
        $umur = $sekarang->diff($lahir);
        
        if ($umur->y > 0) {
            return $umur->y . ' tahun ' . $umur->m . ' bulan';
        } elseif ($umur->m > 0) {
            return $umur->m . ' bulan ' . $umur->d . ' hari';
        } else {
            return $umur->d . ' hari';
        }
    }
}