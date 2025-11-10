<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Menampilkan form create
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Menyimpan data user
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateUser($request);
        
        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        // Format nama
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        
        // Simpan user
        User::create($validatedData);
        
        return redirect()->route('admin.user.index')
                        ->with('success', 'Data user berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update data user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:6'
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);
        
        // Format nama
        $validatedData['nama'] = $this->formatNama($validatedData['nama']);
        
        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }
        
        // Update user
        $user->update($validatedData);
        
        return redirect()->route('admin.user.index')
                        ->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Hapus data user
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Hapus user (role_user akan terhapus otomatis jika ada foreign key cascade)
            $user->delete();
            
            return redirect()->route('admin.user.index')
                            ->with('success', 'Data user berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.user.index')
                            ->with('error', 'Gagal menghapus data! Data mungkin masih digunakan di tabel lain.');
        }
    }

    /**
     * Helper: Validasi data user
     */
    private function validateUser(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email',
            'password' => 'required|string|min:6'
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'nama.max' => 'Nama maksimal 500 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);
    }

    /**
     * Helper: Format nama (huruf pertama kapital setiap kata)
     */
    private function formatNama(string $nama)
    {
        return ucwords(strtolower($nama));
    }
}