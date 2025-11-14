<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Tambahkan untuk konsistensi

class UserController extends Controller
{
    /**
     * Menampilkan daftar user menggunakan Query Builder
     */
    public function index()
    {
        $users = DB::table('user')
                  ->orderBy('nama', 'asc')
                  ->get();
        
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
     * Menyimpan data user menggunakan Query Builder
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validateUser($request);
        
        // Format nama
        $nama = $this->formatNama($validatedData['nama']);
        
        // Hash password
        $password = Hash::make($validatedData['password']);
        
        // Query Builder: Insert data
        DB::table('user')->insert([
            'nama' => $nama,
            'email' => $validatedData['email'],
            'password' => $password
        ]);
        
        return redirect()->route('admin.user.index')
                        ->with('success', 'Data user berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $user = DB::table('user')
                 ->where('iduser', $id)
                 ->first();
        
        if (!$user) {
            return redirect()->route('admin.user.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update data user menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $id . ',iduser',
            'password' => 'nullable|string|min:6'
        ], [
            'nama.required' => 'Nama wajib diisi!',
            'nama.max' => 'Nama maksimal 500 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.min' => 'Password minimal 6 karakter!'
        ]);
        
        // Format nama
        $nama = $this->formatNama($validatedData['nama']);
        
        // Update data
        $updateData = [
            'nama' => $nama,
            'email' => $validatedData['email']
        ];
        
        // Update password jika diisi
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }
        
        // Query Builder: Update data
        DB::table('user')
            ->where('iduser', $id)
            ->update($updateData);
        
        return redirect()->route('admin.user.index')
                        ->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Hapus data user menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            // Query Builder: Delete data
            $deleted = DB::table('user')
                        ->where('iduser', $id)
                        ->delete();
            
            if ($deleted) {
                return redirect()->route('admin.user.index')
                                ->with('success', 'Data user berhasil dihapus!');
            } else {
                return redirect()->route('admin.user.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
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

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total user
    public function countUser()
    {
        $count = DB::table('user')->count();
        return $count;
    }
    
    // 2. Cari user berdasarkan keyword
    public function searchUser($keyword)
    {
        $results = DB::table('user')
                     ->where('nama', 'like', '%' . $keyword . '%')
                     ->orWhere('email', 'like', '%' . $keyword . '%')
                     ->get();
        return $results;
    }
    
    // 3. Ambil 5 user terbaru
    public function getLatestUser()
    {
        $latest = DB::table('user')
                    ->orderBy('iduser', 'desc')
                    ->limit(5)
                    ->get();
        return $latest;
    }
}