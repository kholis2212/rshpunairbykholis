<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    /**
     * Menampilkan daftar role user
     */
    public function index()
    {
        $users = User::with('roleUsers.role')->get();
        return view('admin.role-user.index', compact('users'));
    }

    /**
     * Menampilkan form create (assign role ke user)
     */
    public function create()
    {
        $users = User::with('roleUsers')->get();
        $roles = Role::all();
        return view('admin.role-user.create', compact('users', 'roles'));
    }

    /**
     * Menyimpan assignment role ke user
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:role,idrole'
        ], [
            'iduser.required' => 'Pilih user!',
            'iduser.exists' => 'User tidak ditemukan!',
            'roles.required' => 'Pilih minimal 1 role!',
            'roles.min' => 'Pilih minimal 1 role!',
            'roles.*.exists' => 'Role tidak valid!'
        ]);
        
        $addedCount = 0;
        
        // Cek apakah user sudah punya role yang dipilih
        foreach ($request->roles as $roleId) {
            $exists = RoleUser::where('iduser', $request->iduser)
                             ->where('idrole', $roleId)
                             ->exists();
            
            if (!$exists) {
                RoleUser::create([
                    'iduser' => $request->iduser,
                    'idrole' => $roleId,
                    'status' => 1
                ]);
                $addedCount++;
            }
        }
        
        if ($addedCount > 0) {
            return redirect()->route('admin.role-user.index')
                            ->with('success', 'Role berhasil ditambahkan ke user!');
        } else {
            return redirect()->route('admin.role-user.index')
                            ->with('error', 'Role yang dipilih sudah dimiliki user!');
        }
    }

    /**
     * Menampilkan form edit role user
     */
    public function edit($id)
    {
        $user = User::with('roleUsers')->findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roleUsers->pluck('idrole')->toArray();
        
        return view('admin.role-user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update role user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        // Validasi input
        $validatedData = $request->validate([
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:role,idrole'
        ], [
            'roles.required' => 'Pilih minimal 1 role!',
            'roles.min' => 'Pilih minimal 1 role!',
            'roles.*.exists' => 'Role tidak valid!'
        ]);
        
        // Hapus semua role user yang lama
        RoleUser::where('iduser', $id)->delete();
        
        // Tambahkan role yang baru
        foreach ($request->roles as $roleId) {
            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => $roleId,
                'status' => 1
            ]);
        }
        
        return redirect()->route('admin.role-user.index')
                        ->with('success', 'Role user berhasil diperbarui!');
    }

    /**
     * Hapus role dari user
     */
    public function destroy($id)
    {
        try {
            // $id disini adalah idrole_user
            $roleUser = RoleUser::findOrFail($id);
            
            // Cek apakah user masih punya role lain
            $userRoleCount = RoleUser::where('iduser', $roleUser->iduser)->count();
            
            if ($userRoleCount <= 1) {
                return redirect()->route('admin.role-user.index')
                                ->with('error', 'Tidak bisa menghapus! User harus memiliki minimal 1 role.');
            }
            
            $roleUser->delete();
            
            return redirect()->route('admin.role-user.index')
                            ->with('success', 'Role berhasil dihapus dari user!');
        } catch (\Exception $e) {
            return redirect()->route('admin.role-user.index')
                            ->with('error', 'Gagal menghapus role!');
        }
    }
}