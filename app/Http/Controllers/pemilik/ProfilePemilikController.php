<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pemilik;

class ProfilePemilikController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        return view('pemilik.profile.index', compact('user', 'pemilik'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        $request->validate([
            'nama' => 'required|string|max:500',
            'email' => 'required|email|max:200|unique:user,email,' . $user->iduser . ',iduser',
            'no_wa' => 'nullable|string|max:45',
            'alamat' => 'nullable|string|max:100',
            'password' => 'nullable|min:8|confirmed',
        ], [
            'nama.required' => 'Nama lengkap wajib diisi!',
            'nama.max' => 'Nama maksimal 500 karakter!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah digunakan!',
            'no_wa.max' => 'Nomor WhatsApp maksimal 45 karakter!',
            'alamat.max' => 'Alamat maksimal 100 karakter!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak sesuai!',
        ]);

        try {
            // Update user data
            $userData = [
                'nama' => $request->nama,
                'email' => $request->email,
            ];

            // Update password jika diisi
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Update atau create pemilik data
            $pemilikData = [
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ];

            if ($pemilik) {
                $pemilik->update($pemilikData);
            } else {
                $pemilikData['iduser'] = $user->iduser;
                Pemilik::create($pemilikData);
            }

            return redirect()->route('pemilik.profile.index')
                ->with('success', 'Profile berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}