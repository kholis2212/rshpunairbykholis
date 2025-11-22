<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // HAPUS LINE INI: protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke home
        if (Auth::check()) {
            return redirect('/home');
        }
        
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Ambil user dengan relasi role aktif
        $user = User::with(['roleUsers.role'])
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.'])->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        // Ambil role aktif (jika ada)
        $activeRoleUser = $user->roleUsers->where('status', 1)->first();

        if (!$activeRoleUser || !$activeRoleUser->role) {
            return back()->withErrors(['role' => 'Akun belum memiliki role aktif.'])->withInput();
        }

        $role = $activeRoleUser->role;

        // Login user ke session
        Auth::login($user);

        // Simpan data penting ke session
        $request->session()->put([
            'user_id'        => $user->iduser,
            'user_name'      => $user->nama,
            'user_email'     => $user->email,
            'user_role'      => $role->idrole,
            'user_role_name' => $role->nama_role,
            'user_status'    => $activeRoleUser->status,
        ]);

        // Redirect berdasarkan role
        switch ($role->idrole) {
            case 1:
                return redirect()->route('admin.dashboard-admin')->with('success', 'Login berhasil!');
            case 2:
                return redirect()->route('dokter.dashboard-dokter')->with('success', 'Login berhasil!');
            case 3:
                return redirect()->route('perawat.dashboard-perawat')->with('success', 'Login berhasil!');
            case 4:
                return redirect()->route('resepsionis.dashboard-resepsionis')->with('success', 'Login berhasil!');
            case 5:
                return redirect()->route('pemilik.dashboard-pemilik')->with('success', 'Login berhasil!');
            default:
                Auth::logout();
                return back()->withErrors(['role' => 'Role tidak dikenali.'])->withInput();
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!'); // Redirect ke login setelah logout
    }
}