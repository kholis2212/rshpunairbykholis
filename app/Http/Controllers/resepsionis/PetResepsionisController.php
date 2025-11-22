<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetResepsionisController extends Controller
{
    /**
     * Menampilkan daftar pet
     */
 public function index()
{
    $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
        ->orderBy('nama', 'asc')
        ->get();

    return view('resepsionis.registrasi.pet.index', compact('pets'));
}

    /**
     * Menampilkan form create pet
     */
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::all();

        return view('resepsionis.registrasi.pet.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Mendapatkan ras hewan berdasarkan jenis hewan (AJAX)
     */
    public function getRasByJenis($idJenisHewan)
    {
        $rasHewan = RasHewan::where('idjenis_hewan', $idJenisHewan)->get();
        return response()->json($rasHewan);
    }

    /**
     * Menyimpan data pet baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ], [
            'nama.required' => 'Nama hewan wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'warna_tanda.required' => 'Warna/tanda wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'idpemilik.required' => 'Pemilik wajib dipilih!',
            'idras_hewan.required' => 'Ras hewan wajib dipilih!',
        ]);

        try {
            // Buat data pet
            Pet::create($validatedData);

            return redirect()->route('resepsionis.registrasi.pet.index')
                ->with('success', 'Data pet berhasil ditambahkan!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menambahkan data pet: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Menampilkan form edit pet
     */
    public function edit($id)
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->findOrFail($id);
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::where('idjenis_hewan', $pet->rasHewan->idjenis_hewan)->get();

        return view('resepsionis.registrasi.pet.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan'));
    }

    /**
     * Update data pet
     */
    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ], [
            'nama.required' => 'Nama hewan wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'warna_tanda.required' => 'Warna/tanda wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'idpemilik.required' => 'Pemilik wajib dipilih!',
            'idras_hewan.required' => 'Ras hewan wajib dipilih!',
        ]);

        try {
            // Update data pet
            $pet->update($validatedData);

            return redirect()->route('resepsionis.registrasi.pet.index')
                ->with('success', 'Data pet berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Gagal memperbarui data pet: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Hapus data pet
     */
    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();

            return redirect()->route('resepsionis.registrasi.pet.index')
                ->with('success', 'Data pet berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('resepsionis.registrasi.pet.index')
                ->with('error', 'Gagal menghapus data pet! Data mungkin masih digunakan di tabel lain.');
        }
    }
}