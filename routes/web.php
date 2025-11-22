<?php

// Web Routes
use Illuminate\Support\Facades\Route;

// Controllers Site
use App\Http\Controllers\Site\SiteController;

// Controllers Admin
use App\Http\Controllers\Admin\DashboardAdminController;
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

// Controllers Dokter
use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\ProfileDokterController;
use App\Http\Controllers\Dokter\RekamMedisDokterController;

// Controllers Resepsionis
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\RegistrasiController;
use App\Http\Controllers\Resepsionis\PetResepsionisController;
use App\Http\Controllers\Resepsionis\TemuDokterController;
use App\Http\Controllers\Resepsionis\PemilikResepsionisController;

// Controllers Perawat
use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Perawat\ProfilePerawatController;
use App\Http\Controllers\Perawat\RekamMedisPerawatController;

// Controllers Pemilik
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Pemilik\ProfilePemilikController;
use App\Http\Controllers\Pemilik\PetPemilikController;
use App\Http\Controllers\Pemilik\ReservasiController;
use App\Http\Controllers\Pemilik\RekamMedisPemilikController;

// Controllers Auth
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

// ------------------ HOME ------------------
Route::get('/', [SiteController::class, 'beranda'])->name('beranda');
Route::get('/layananumum', [SiteController::class, 'layanan'])->name('layanan');
Route::get('/strukturorganisasi', [SiteController::class, 'struktur'])->name('struktur');
Route::get('/visimisidantujuan', [SiteController::class, 'visimisi'])->name('visimisi');
Route::get('/cekKoneksi', [SiteController::class, 'cekKoneksi'])->name('cekKoneksi');

// ------------------ ADMIN ------------------
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

});

// ------------------ DOKTER ------------------
Route::middleware(['auth'])->prefix('dokter')->name('dokter.')->group(function () {
    // Dashboard Dokter
    Route::get('dashboard-dokter', [DashboardDokterController::class, 'index'])->name('dashboard-dokter');
    
    // Profile Dokter
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileDokterController::class, 'index'])->name('index');
        Route::put('/update', [ProfileDokterController::class, 'update'])->name('update');
    });
    
    // Rekam Medis - DOKTER HANYA BISA VIEW REKAM MEDIS, TAPI BISA CRUD DETAIL
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        // Daftar rekam medis (VIEW ONLY)
        Route::get('/', [RekamMedisDokterController::class, 'index'])->name('index');
        
        // Detail rekam medis (VIEW ONLY)
        Route::get('{id}', [RekamMedisDokterController::class, 'show'])->name('show');
        
        // Tambah detail/tindakan ke rekam medis yang sudah ada
        Route::get('{id}/tindakan/create', [RekamMedisDokterController::class, 'createDetail'])->name('tindakan.create');
        Route::post('{id}/tindakan/store', [RekamMedisDokterController::class, 'storeDetail'])->name('tindakan.store');
        
        // Edit detail/tindakan
        Route::get('{id}/tindakan/{idDetail}/edit', [RekamMedisDokterController::class, 'editDetail'])->name('tindakan.edit');
        Route::put('{id}/tindakan/{idDetail}', [RekamMedisDokterController::class, 'updateDetail'])->name('tindakan.update');
        Route::delete('{id}/tindakan/{idDetail}', [RekamMedisDokterController::class, 'destroyDetail'])->name('tindakan.destroy');
    });
});

// ------------------ RESEPSIONIS ------------------
Route::middleware(['auth'])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    // Dashboard
    Route::get('dashboard-resepsionis', [DashboardResepsionisController::class, 'index'])->name('dashboard-resepsionis');
    
    // Registrasi
    Route::prefix('registrasi')->name('registrasi.')->group(function () {
        Route::get('/pemilik', [RegistrasiController::class, 'pemilik'])->name('pemilik');
        Route::get('/pet', [RegistrasiController::class, 'pet'])->name('pet');
        
        // CRUD Pemilik
        Route::get('/pemilik/index', [PemilikResepsionisController::class, 'index'])->name('pemilik.index');
        Route::get('/pemilik/create', [PemilikResepsionisController::class, 'create'])->name('pemilik.create');
        Route::post('/pemilik', [PemilikResepsionisController::class, 'store'])->name('pemilik.store');
        Route::get('/pemilik/{id}/edit', [PemilikResepsionisController::class, 'edit'])->name('pemilik.edit');
        Route::put('/pemilik/{id}', [PemilikResepsionisController::class, 'update'])->name('pemilik.update');
        Route::delete('/pemilik/{id}', [PemilikResepsionisController::class, 'destroy'])->name('pemilik.destroy');
        
        // CRUD Pet
        Route::get('/pet/index', [PetResepsionisController::class, 'index'])->name('pet.index');
        Route::get('/pet/create', [PetResepsionisController::class, 'create'])->name('pet.create');
        Route::post('/pet', [PetResepsionisController::class, 'store'])->name('pet.store');
        Route::get('/pet/{id}/edit', [PetResepsionisController::class, 'edit'])->name('pet.edit');
        Route::put('/pet/{id}', [PetResepsionisController::class, 'update'])->name('pet.update');
        Route::delete('/pet/{id}', [PetResepsionisController::class, 'destroy'])->name('pet.destroy');
        Route::get('/pet/get-ras/{idJenisHewan}', [PetResepsionisController::class, 'getRasByJenis'])->name('pet.get-ras');
    });
    
    // Temu Dokter
    Route::prefix('temu-dokter')->name('temu-dokter.')->group(function () {
        Route::get('/', [TemuDokterController::class, 'index'])->name('index');
        Route::get('/create', [TemuDokterController::class, 'create'])->name('create');
        Route::post('/', [TemuDokterController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TemuDokterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TemuDokterController::class, 'update'])->name('update');
        Route::delete('/{id}', [TemuDokterController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/status', [TemuDokterController::class, 'updateStatus'])->name('update-status');
    });
});

// ------------------ PERAWAT ------------------
Route::middleware(['auth', 'isPerawat'])->prefix('perawat')->name('perawat.')->group(function () {
    // Dashboard Perawat
    Route::get('dashboard-perawat', [DashboardPerawatController::class, 'index'])->name('dashboard-perawat');
    
    // Profile Perawat
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfilePerawatController::class, 'index'])->name('index');
        Route::put('/update', [ProfilePerawatController::class, 'update'])->name('update');
    });
    
    // Rekam Medis
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        Route::get('/', [RekamMedisPerawatController::class, 'index'])->name('index');
        Route::get('create', [RekamMedisPerawatController::class, 'create'])->name('create');
        Route::post('store', [RekamMedisPerawatController::class, 'store'])->name('store');
        Route::get('{id}', [RekamMedisPerawatController::class, 'show'])->name('show');
        Route::get('{id}/edit', [RekamMedisPerawatController::class, 'edit'])->name('edit');
        Route::put('{id}', [RekamMedisPerawatController::class, 'update'])->name('update');
        Route::delete('{id}', [RekamMedisPerawatController::class, 'destroy'])->name('destroy');
    });
});

// ------------------ PEMILIK ------------------
Route::middleware(['auth', 'isPemilik'])->prefix('pemilik')->name('pemilik.')->group(function () {
    // Dashboard Pemilik
    Route::get('dashboard-pemilik', [DashboardPemilikController::class, 'index'])->name('dashboard-pemilik');
    
    // Profile Pemilik
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfilePemilikController::class, 'index'])->name('index');
        Route::put('/update', [ProfilePemilikController::class, 'update'])->name('update');
    });
    
    // Pet Pemilik
    Route::prefix('pet')->name('pet.')->group(function () {
        Route::get('/', [PetPemilikController::class, 'index'])->name('index');
    });
    
    // Reservasi
    Route::prefix('reservasi')->name('reservasi.')->group(function () {
        Route::get('/', [ReservasiController::class, 'index'])->name('index');
        Route::get('/{id}', [ReservasiController::class, 'show'])->name('show');
    });
    
    // Rekam Medis
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {
        Route::get('/', [RekamMedisPemilikController::class, 'index'])->name('index');
        Route::get('{id}', [RekamMedisPemilikController::class, 'show'])->name('show');
        // Tambahkan route ini
        Route::get('pet/{idpet}', [RekamMedisPemilikController::class, 'byPet'])->name('by-pet');
    });
});