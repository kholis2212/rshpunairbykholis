<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with('pemilik', 'rasHewan')->get(); // Mengambil semua data pet dengan relasi
        return view('admin.pet.index', compact('pet'));
    }
}