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

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDokterController;
use App\Http\Controllers\DashboardPerawatController;
use App\Http\Controllers\DashboardResepsionisController;
use App\Http\Controllers\DashboardPemilikController;

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

// Dashboard masing-masing role
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
// Admin
Route::middleware(['auth', 'isAdministrator'])->group(function () {
    Route::get('/dashboard-admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
});

// Dokter
Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dashboard-dokter', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

// Perawat
Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/dashboard-perawat', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

// Resepsionis
Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/dashboard-resepsionis', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

// Pemilik
Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/dashboard-pemilik', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
});

// ------------------ ADMIN CRUD ------------------
Route::middleware(['auth', 'isAdministrator'])->group(function () {
    Route::get('/admin/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
    Route::get('/admin/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
    Route::get('/admin/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
    Route::get('/admin/pet', [PetController::class, 'index'])->name('admin.pet.index');
    Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('/admin/role-user', [RoleUserController::class, 'index'])->name('admin.role-user.index');
    Route::get('/admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
});


