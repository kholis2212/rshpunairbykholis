<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilePerawatController extends Controller
{
    /**
     * Menampilkan profile perawat
     */
    public function index()
    {
        $user = Auth::user();
        $perawat = Perawat::where('iduser', $user->iduser)->first();
        
        return view('perawat.profile.index', compact('user', 'perawat'));
    }

    /**
     * Update profile perawat
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $perawat = Perawat::where('iduser', $user->iduser)->first();

        $validatedData = $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $user->iduser . ',iduser',
            'alamat' => 'nullable|string|max:100',
            'no_hp' => 'nullable|string|max:45',
            'pendidikan' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|string|in:L,P',
            'password' => 'nullable|min:6|confirmed',
        ]);

        DB::transaction(function () use ($user, $perawat, $validatedData) {
            // Update user data
            $userData = [
                'nama' => $validatedData['nama'],
                'email' => $validatedData['email'],
            ];

            if (!empty($validatedData['password'])) {
                $userData['password'] = Hash::make($validatedData['password']);
            }

            $user->update($userData);

            // Update atau create perawat data
            $perawatData = [
                'alamat' => $validatedData['alamat'],
                'no_hp' => $validatedData['no_hp'],
                'pendidikan' => $validatedData['pendidikan'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'],
            ];

            if ($perawat) {
                $perawat->update($perawatData);
            } else {
                Perawat::create(array_merge(['iduser' => $user->iduser], $perawatData));
            }
        });

        return redirect()->route('perawat.profile.index')
            ->with('success', 'Profile berhasil diperbarui!');
    }
}