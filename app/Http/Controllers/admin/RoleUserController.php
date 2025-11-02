<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        // Ambil semua user beserta relasi roleUsers dan role-nya
        $users = User::with('roleUsers.role')->get();

        return view('admin.roleuser.index', compact('users'));
    }
}
