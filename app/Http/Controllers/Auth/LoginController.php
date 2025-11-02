<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login dengan custom validation
    public function login(Request $request)
    {
        // Validasi input
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cari user dengan eager loading roleUser dan role
        $user = User::with(['roleUsers' => function($query) {
            $query->where('status', 1);
        }, 'roleUsers.role'])
            ->where('email', $request->input('email'))
            ->first();

        // Cek apakah user ditemukan
        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Ambil nama role dari relasi
        $namaRole = Role::where('idrole', $user->roleUsers[0]->idrole ?? null)->first();

        // Login user ke session
        Auth::login($user);

        // Simpan data user ke session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role' => $user->roleUsers[0]->idrole ?? 'user',
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUsers[0]->status ?? 'active'
        ]);

        // Ambil role user untuk redirect
        $userRole = $user->roleUsers[0]->idrole ?? null;

        // Redirect berdasarkan role
        switch ($userRole) {
            case '1':
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case '2':
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case '3':
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case '4':
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case '5':
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            default:
            return redirect()->route('/home')->with('success', 'Login berhasil!');
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}