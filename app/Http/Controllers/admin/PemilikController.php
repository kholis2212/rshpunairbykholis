<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar pemilik menggunakan Query Builder
     */
    public function index()
    {
        $pemilik = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.*', 'user.nama', 'user.email')
                    ->orderBy('user.nama', 'asc')
                    ->get();
        
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
 * Menyimpan data pemilik menggunakan Query Builder
 */
public function store(Request $request)
{
    // Debug: Log request data
    \Log::info('Pemilik Store Request:', $request->all());

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

    \Log::info('Validation passed:', $validatedData);

    try {
        DB::beginTransaction();

        \Log::info('Starting transaction...');

        // 1. Buat user terlebih dahulu - SEDERHANAKAN DULU
        $userData = [
            'nama' => $validatedData['nama'], // Sementara tanpa format
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ];

        \Log::info('User data to insert:', $userData);

        $userId = DB::table('user')->insertGetId($userData);

        \Log::info('User created with ID: ' . $userId);

        if (!$userId) {
            throw new \Exception('Gagal membuat user');
        }

        // 2. Buat data pemilik - SEDERHANAKAN DULU
        $pemilikData = [
            'no_wa' => $validatedData['no_wa'], // Sementara tanpa format
            'alamat' => $validatedData['alamat'],
            'iduser' => $userId,
        ];

        \Log::info('Pemilik data to insert:', $pemilikData);

        $pemilikId = DB::table('pemilik')->insertGetId($pemilikData);

        \Log::info('Pemilik created with ID: ' . $pemilikId);

        if (!$pemilikId) {
            throw new \Exception('Gagal membuat data pemilik');
        }

        DB::commit();

        \Log::info('Transaction committed successfully');

        return redirect()->route('admin.pemilik.index')
                        ->with('success', 'Data pemilik berhasil ditambahkan!');

    } catch (\Exception $e) {
        DB::rollBack();
        
        \Log::error('Error storing pemilik: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());

        // Cek error spesifik
        $errorMessage = 'Gagal menambahkan data: ' . $e->getMessage();
        
        // Jika error database, tampilkan pesan yang lebih user-friendly
        if (str_contains($e->getMessage(), 'SQLSTATE')) {
            $errorMessage = 'Gagal menambahkan data. Terjadi kesalahan database.';
        }

        return redirect()->back()
                        ->withInput()
                        ->with('error', $errorMessage);
    }
}
         
    /**
     * Menampilkan form edit menggunakan Query Builder
     */
    public function edit($id)
    {
        $pemilik = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.*', 'user.nama', 'user.email')
                    ->where('pemilik.idpemilik', $id)
                    ->first();
        
        if (!$pemilik) {
            return redirect()->route('admin.pemilik.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update data pemilik menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
        $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
        
        if (!$pemilik) {
            return redirect()->route('admin.pemilik.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
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
            $userData = [
                'nama' => $this->formatNama($validatedData['nama']),
                'email' => $validatedData['email'],
            ];
            
            // Update password hanya jika diisi
            if (!empty($validatedData['password'])) {
                $userData['password'] = Hash::make($validatedData['password']);
            }
            
            DB::table('user')
                ->where('iduser', $pemilik->iduser)
                ->update($userData);

            // 2. Update data pemilik
            DB::table('pemilik')
                ->where('idpemilik', $id)
                ->update([
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
     * Hapus data pemilik menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pemilik = DB::table('pemilik')->where('idpemilik', $id)->first();
            
            if (!$pemilik) {
                return redirect()->route('admin.pemilik.index')
                                ->with('error', 'Data tidak ditemukan!');
            }

            $userId = $pemilik->iduser;

            // Hapus pemilik terlebih dahulu
            DB::table('pemilik')->where('idpemilik', $id)->delete();

            // Hapus user
            DB::table('user')->where('iduser', $userId)->delete();

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

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total pemilik
    public function countPemilik()
    {
        $count = DB::table('pemilik')->count();
        return $count;
    }
    
    // 2. Cari pemilik berdasarkan keyword
    public function searchPemilik($keyword)
    {
        $results = DB::table('pemilik')
                     ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                     ->select('pemilik.*', 'user.nama', 'user.email')
                     ->where('user.nama', 'like', '%' . $keyword . '%')
                     ->orWhere('user.email', 'like', '%' . $keyword . '%')
                     ->orWhere('pemilik.no_wa', 'like', '%' . $keyword . '%')
                     ->orWhere('pemilik.alamat', 'like', '%' . $keyword . '%')
                     ->orderBy('user.nama', 'asc')
                     ->get();
        return $results;
    }
    
    // 3. Ambil 5 pemilik terbaru
    public function getLatestPemilik()
    {
        $latest = DB::table('pemilik')
                    ->join('user', 'pemilik.iduser', '=', 'user.iduser')
                    ->select('pemilik.*', 'user.nama', 'user.email')
                    ->orderBy('pemilik.idpemilik', 'desc')
                    ->limit(5)
                    ->get();
        return $latest;
    }
}