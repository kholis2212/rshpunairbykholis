<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileDokterController extends Controller
{
    /**
     * Menampilkan profile dokter
     */
    public function index()
    {
        $user = Auth::user();
        $dokter = Dokter::where('iduser', $user->iduser)->first();
        
        return view('dokter.profile.index', compact('user', 'dokter'));
    }

    /**
     * Update profile dokter
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $dokter = Dokter::where('iduser', $user->iduser)->first();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $user->iduser . ',iduser',
            'alamat' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:45',
            'bidang_dokter' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'password' => 'nullable|min:6|confirmed',
        ]);

        DB::transaction(function () use ($user, $dokter, $validatedData) {
            // Update user data
            $userData = [
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ];

            if (!empty($validatedData['password'])) {
                $userData['password'] = Hash::make($validatedData['password']);
            }

            $user->update($userData);

            // Update atau create dokter data
            $dokterData = [
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_hp'],
                'bidang_dokter' => $validatedData['bidang_dokter'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
            ];

            if ($dokter) {
                $dokter->update($dokterData);
            } else {
                Dokter::create(array_merge(['iduser' => $user->iduser], $dokterData));
            }
        });

        return redirect()->route('dokter.profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }
}