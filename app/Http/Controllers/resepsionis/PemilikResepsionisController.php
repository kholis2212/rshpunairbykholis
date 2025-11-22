<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PemilikResepsionisController extends Controller
{
    /**
     * Menampilkan daftar pemilik
     */
   public function index()
{
    $pemilik = Pemilik::with(['user' => function($query) {
            $query->orderBy('nama', 'asc');
        }])
        ->get();

    return view('resepsionis.registrasi.pemilik.index', compact('pemilik'));
}

    /**
     * Menampilkan form create pemilik
     */
    public function create()
    {
        return view('resepsionis.registrasi.pemilik.create');
    }

    /**
     * Menyimpan data pemilik baru
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ]);

        try {
            DB::beginTransaction();

            // Buat user baru
            $user = User::create([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'password' => Hash::make('password123'), // Password default
            ]);

            // Buat data pemilik
            $pemilik = Pemilik::create([
                'no_wa' => $validatedData['no_wa'],
                'alamat' => $validatedData['alamat'],
                'iduser' => $user->iduser,
            ]);

            DB::commit();

            return redirect()->route('resepsionis.registrasi.pemilik.index')
                ->with('success', 'Data pemilik berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal menambahkan data pemilik: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Menampilkan form edit pemilik
     */
    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.registrasi.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update data pemilik
     */
    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|unique:user,email,' . $pemilik->user->iduser . ',iduser',
            'no_wa' => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah terdaftar!',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
        ]);

        try {
            DB::beginTransaction();

            // Update user
            $pemilik->user->update([
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ]);

            // Update pemilik
            $pemilik->update([
                'no_wa' => $validatedData['no_wa'],
                'alamat' => $validatedData['alamat'],
            ]);

            DB::commit();

            return redirect()->route('resepsionis.registrasi.pemilik.index')
                ->with('success', 'Data pemilik berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => 'Gagal memperbarui data pemilik: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Hapus data pemilik
     */
    public function destroy($id)
    {
        try {
            $pemilik = Pemilik::with('user')->findOrFail($id);
            
            DB::beginTransaction();
            
            // Hapus pemilik dan user
            $pemilik->delete();
            $pemilik->user->delete();
            
            DB::commit();

            return redirect()->route('resepsionis.registrasi.pemilik.index')
                ->with('success', 'Data pemilik berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('resepsionis.registrasi.pemilik.index')
                ->with('error', 'Gagal menghapus data pemilik! Data mungkin masih digunakan di tabel lain.');
        }
    }
}