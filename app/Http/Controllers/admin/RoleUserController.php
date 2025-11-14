<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleUserController extends Controller
{
    /**
     * Menampilkan daftar role user menggunakan Query Builder
     */
    public function index()
    {
        $users = DB::table('user')
                  ->select('user.iduser', 'user.nama', 'user.email')
                  ->addSelect(DB::raw('GROUP_CONCAT(role.nama_role) as role_names'))
                  ->addSelect(DB::raw('GROUP_CONCAT(role_user.idrole_user) as role_user_ids'))
                  ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
                  ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
                  ->groupBy('user.iduser', 'user.nama', 'user.email')
                  ->orderBy('user.nama', 'asc')
                  ->get();
        
        return view('admin.role-user.index', compact('users'));
    }

    /**
     * Menampilkan form create (assign role ke user)
     */
    public function create()
    {
        $users = DB::table('user')->orderBy('nama', 'asc')->get();
        $roles = DB::table('role')->orderBy('nama_role', 'asc')->get();
        
        // Ambil role untuk setiap user
        $userRoles = [];
        foreach ($users as $user) {
            $userRoles[$user->iduser] = DB::table('role_user')
                ->where('iduser', $user->iduser)
                ->pluck('idrole')
                ->toArray();
        }
        
        return view('admin.role-user.create', compact('users', 'roles', 'userRoles'));
    }

    /**
     * Menyimpan assignment role ke user menggunakan Query Builder
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
            $exists = DB::table('role_user')
                       ->where('iduser', $request->iduser)
                       ->where('idrole', $roleId)
                       ->exists();
            
            if (!$exists) {
                DB::table('role_user')->insert([
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
     * Menampilkan form edit role user menggunakan Query Builder
     */
    public function edit($id)
    {
        $user = DB::table('user')->where('iduser', $id)->first();
        
        if (!$user) {
            return redirect()->route('admin.role-user.index')
                           ->with('error', 'Data tidak ditemukan!');
        }
        
        $roles = DB::table('role')->orderBy('nama_role', 'asc')->get();
        $userRoles = DB::table('role_user')
                      ->where('iduser', $id)
                      ->pluck('idrole')
                      ->toArray();
        
        return view('admin.role-user.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update role user menggunakan Query Builder
     */
    public function update(Request $request, $id)
    {
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
        DB::table('role_user')->where('iduser', $id)->delete();
        
        // Tambahkan role yang baru
        foreach ($request->roles as $roleId) {
            DB::table('role_user')->insert([
                'iduser' => $id,
                'idrole' => $roleId,
                'status' => 1
            ]);
        }
        
        return redirect()->route('admin.role-user.index')
                        ->with('success', 'Role user berhasil diperbarui!');
    }

    /**
     * Hapus role dari user menggunakan Query Builder
     */
    public function destroy($id)
    {
        try {
            // $id disini adalah idrole_user
            $roleUser = DB::table('role_user')->where('idrole_user', $id)->first();
            
            if (!$roleUser) {
                return redirect()->route('admin.role-user.index')
                                ->with('error', 'Data tidak ditemukan!');
            }
            
            // Cek apakah user masih punya role lain
            $userRoleCount = DB::table('role_user')
                              ->where('iduser', $roleUser->iduser)
                              ->count();
            
            if ($userRoleCount <= 1) {
                return redirect()->route('admin.role-user.index')
                                ->with('error', 'Tidak bisa menghapus! User harus memiliki minimal 1 role.');
            }
            
            DB::table('role_user')->where('idrole_user', $id)->delete();
            
            return redirect()->route('admin.role-user.index')
                            ->with('success', 'Role berhasil dihapus dari user!');
        } catch (\Exception $e) {
            return redirect()->route('admin.role-user.index')
                            ->with('error', 'Gagal menghapus role!');
        }
    }

    /**
     * QUERY BUILDER LAINNYA 
     */
    
    // 1. Count total assignment role user
    public function countRoleUser()
    {
        $count = DB::table('role_user')->count();
        return $count;
    }
    
    // 2. Cari role user berdasarkan keyword
    public function searchRoleUser($keyword)
    {
        $results = DB::table('user')
                     ->select('user.iduser', 'user.nama', 'user.email')
                     ->addSelect(DB::raw('GROUP_CONCAT(role.nama_role) as role_names'))
                     ->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')
                     ->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')
                     ->where('user.nama', 'like', '%' . $keyword . '%')
                     ->orWhere('user.email', 'like', '%' . $keyword . '%')
                     ->orWhere('role.nama_role', 'like', '%' . $keyword . '%')
                     ->groupBy('user.iduser', 'user.nama', 'user.email')
                     ->get();
        return $results;
    }
    
    // 3. Ambil 5 assignment terbaru
    public function getLatestRoleUser()
    {
        $latest = DB::table('role_user')
                    ->join('user', 'role_user.iduser', '=', 'user.iduser')
                    ->join('role', 'role_user.idrole', '=', 'role.idrole')
                    ->select('role_user.*', 'user.nama as user_name', 'role.nama_role as role_name')
                    ->orderBy('role_user.idrole_user', 'desc')
                    ->limit(5)
                    ->get();
        return $latest;
    }
}