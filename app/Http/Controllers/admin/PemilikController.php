<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar pemilik
     */
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.pemilik.create');
    }

    /**
     * Menyimpan data pemilik
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email',
            'password' => 'required|string|min:6|confirmed',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama pemilik wajib diisi!',
            'nama.max' => 'Nama pemilik maksimal 500 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'alamat.max' => 'Alamat maksimal 100 karakter!',
        ]);

        try {
            DB::beginTransaction();

            // 1. Buat user terlebih dahulu
            $user = User::create([
                'nama' => $this->formatNama($validatedData['nama']),
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // 2. Buat data pemilik
            Pemilik::create([
                'no_wa' => $this->formatNoWa($validatedData['no_wa']),
                'alamat' => $validatedData['alamat'],
                'iduser' => $user->iduser,
            ]);

            DB::commit();

            return redirect()->route('admin.pemilik.index')
                            ->with('success', 'Data pemilik berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update data pemilik
     */
    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        // Validasi input (email unique kecuali user ini)
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $pemilik->iduser . ',iduser',
            'password' => 'nullable|string|min:6|confirmed',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama pemilik wajib diisi!',
            'nama.max' => 'Nama pemilik maksimal 500 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'alamat.max' => 'Alamat maksimal 100 karakter!',
        ]);

        try {
            DB::beginTransaction();

            // 1. Update data user
            $user = User::findOrFail($pemilik->iduser);
            $user->nama = $this->formatNama($validatedData['nama']);
            $user->email = $validatedData['email'];
            
            // Update password hanya jika diisi
            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']);
            }
            
            $user->save();

            // 2. Update data pemilik
            $pemilik->update([
                'no_wa' => $this->formatNoWa($validatedData['no_wa']),
                'alamat' => $validatedData['alamat'],
            ]);

            DB::commit();

            return redirect()->route('admin.pemilik.index')
                            ->with('success', 'Data pemilik berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data pemilik
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pemilik = Pemilik::findOrFail($id);
            $userId = $pemilik->iduser;

            // Hapus pemilik terlebih dahulu
            $pemilik->delete();

            // Hapus user
            User::findOrFail($userId)->delete();

            DB::commit();

            return redirect()->route('admin.pemilik.index')
                            ->with('success', 'Data pemilik berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.pemilik.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Format nama (huruf pertama kapital)
     */
    private function formatNama(string $nama)
    {
        return ucwords(strtolower($nama));
    }

    /**
     * Helper: Format nomor WA (hilangkan spasi, strip)
     */
    private function formatNoWa(string $noWa)
    {
        // Hilangkan semua karakter selain angka dan +
        $noWa = preg_replace('/[^0-9+]/', '', $noWa);
        
        // Jika diawali 0, ganti dengan +62
        if (substr($noWa, 0, 1) === '0') {
            $noWa = '+62' . substr($noWa, 1);
        }
        
        // Jika diawali 62 tanpa +, tambahkan +
        if (substr($noWa, 0, 2) === '62' && substr($noWa, 0, 1) !== '+') {
            $noWa = '+' . $noWa;
        }
        
        return $noWa;
    }
}