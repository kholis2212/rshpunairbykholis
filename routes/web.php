<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;

// ------------------ AUTH ------------------
//Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Password Reset Routes
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// ------------------ FRONTEND ------------------
Route::get('/', [SiteController::class, 'beranda'])->name('beranda');
Route::get('/layananumum', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/strukturorganisasi', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/visimisidantujuan', [SiteController::class, 'visimisi'])->name('visimisi');
Route::get('/cekKoneksi', [SiteController::class, 'cekKoneksi'])->name('cekKoneksi');

// ------------------ DASHBOARD ------------------

// Dokter
Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

// Perawat
Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

// Resepsionis
Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

// Pemilik
Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
});

// ------------------ ADMIN CRUD ------------------
Route::middleware(['auth', 'isAdministrator'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard-admin');

    // User - CRUD Lengkap
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('{id}', [UserController::class, 'update'])->name('update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Role - CRUD Lengkap
    Route::prefix('role-user')->name('role-user.')->group(function () {
        Route::get('/', [RoleUserController::class, 'index'])->name('index');
        Route::get('create', [RoleUserController::class, 'create'])->name('create');
        Route::post('store', [RoleUserController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RoleUserController::class, 'edit'])->name('edit');
        Route::put('{id}', [RoleUserController::class, 'update'])->name('update');
        Route::delete('{id}', [RoleUserController::class, 'destroy'])->name('destroy');
    });

    // Jenis Hewan - CRUD Lengkap
    Route::prefix('jenis-hewan')->name('jenis-hewan.')->group(function () {
        Route::get('/', [JenisHewanController::class, 'index'])->name('index');
        Route::get('create', [JenisHewanController::class, 'create'])->name('create');
        Route::post('store', [JenisHewanController::class, 'store'])->name('store');
        Route::get('{id}/edit', [JenisHewanController::class, 'edit'])->name('edit');
        Route::put('{id}', [JenisHewanController::class, 'update'])->name('update');
        Route::delete('{id}', [JenisHewanController::class, 'destroy'])->name('destroy');
    });

    // Ras Hewan - CRUD Lengkap
    Route::prefix('ras-hewan')->name('ras-hewan.')->group(function () {
        Route::get('/', [RasHewanController::class, 'index'])->name('index');
        Route::get('create', [RasHewanController::class, 'create'])->name('create');
        Route::post('store', [RasHewanController::class, 'store'])->name('store');
        Route::get('{id}/edit', [RasHewanController::class, 'edit'])->name('edit');
        Route::put('{id}', [RasHewanController::class, 'update'])->name('update');
        Route::delete('{id}', [RasHewanController::class, 'destroy'])->name('destroy');
    });

    // Pemilik - CRUD Lengkap
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/', [PemilikController::class, 'index'])->name('index');
        Route::get('create', [PemilikController::class, 'create'])->name('create');
        Route::post('store', [PemilikController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PemilikController::class, 'edit'])->name('edit');
        Route::put('{id}', [PemilikController::class, 'update'])->name('update');
        Route::delete('{id}', [PemilikController::class, 'destroy'])->name('destroy');
    });

    // Pemilik - CRUD Lengkap
    Route::prefix('pet')->name('pet.')->group(function () {
        Route::get('/', [PetController::class, 'index'])->name('index');
        Route::get('create', [PetController::class, 'create'])->name('create');
        Route::post('store', [PetController::class, 'store'])->name('store');
        Route::get('{id}/edit', [PetController::class, 'edit'])->name('edit');
        Route::put('{id}', [PetController::class, 'update'])->name('update');
        Route::delete('{id}', [PetController::class, 'destroy'])->name('destroy');
    });
    
    // Kategori - CRUD Lengkap
    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('create', [KategoriController::class, 'create'])->name('create');
        Route::post('store', [KategoriController::class, 'store'])->name('store');
        Route::get('{id}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('{id}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    // Kategori Klinis - CRUD Lengkap
    Route::prefix('kategori-klinis')->name('kategori-klinis.')->group(function () {
        Route::get('/', [KategoriKlinisController::class, 'index'])->name('index');
        Route::get('create', [KategoriKlinisController::class, 'create'])->name('create');
        Route::post('store', [KategoriKlinisController::class, 'store'])->name('store');
        Route::get('{id}/edit', [KategoriKlinisController::class, 'edit'])->name('edit');
        Route::put('{id}', [KategoriKlinisController::class, 'update'])->name('update');
        Route::delete('{id}', [KategoriKlinisController::class, 'destroy'])->name('destroy');
    });

    // Kode Tindakan Terapi - CRUD Lengkap
    Route::prefix('kode-tindakan-terapi')->name('kode-tindakan-terapi.')->group(function () {
        Route::get('/', [KodeTindakanTerapiController::class, 'index'])->name('index');
        Route::get('create', [KodeTindakanTerapiController::class, 'create'])->name('create');
        Route::post('store', [KodeTindakanTerapiController::class, 'store'])->name('store');
        Route::get('{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('edit');
        Route::put('{id}', [KodeTindakanTerapiController::class, 'update'])->name('update');
        Route::delete('{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('destroy');
    });

    // Route lainnya (belum dimodifikasi)
    
    Route::get('kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('kode-tindakan-terapi.index');
    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::get('role-user', [RoleUserController::class, 'index'])->name('role-user.index');
});