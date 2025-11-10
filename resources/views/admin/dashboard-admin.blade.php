@extends('layouts.lte.main')

@section('title', 'Dashboard Admin - RSHP UNAIR')

@section('page-title', 'Dashboard Administrator')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Alert Success -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Welcome Card -->
    <div class="card mb-4" style="background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%); color: white; border: 3px solid #ffc300;">
        <div class="card-body" style="padding: 35px;">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; margin: 0 auto; box-shadow: 0 8px 25px rgba(0,0,0,0.2); animation: bounce 2s ease-in-out infinite;">
                        👨‍💼
                    </div>
                </div>
                <div class="col-md-10">
                    <h2 class="mb-2" style="font-weight: 800; font-size: 2rem;">
                        Selamat Datang, {{ Auth::user()->nama }}!
                    </h2>
                    <p class="mb-2" style="font-size: 1.1rem; opacity: 0.95; line-height: 1.6;">
                        Anda login sebagai <strong>Administrator</strong><br>
                        Kelola seluruh sistem dan data master RSHP Universitas Airlangga dengan akses penuh
                    </p>
                    <span class="badge" style="font-size: 0.95rem; padding: 10px 25px; background: linear-gradient(135deg, #ffc300, #ffdb4d); color: #023e8a; font-weight: 700; box-shadow: 0 4px 15px rgba(255,195,0,0.4);">
                        <i class="bi bi-star-fill"></i> ADMINISTRATOR
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Title -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card" style="background: linear-gradient(135deg, #f8fbff, #e3f2fd); border: 2px solid #0077b6;">
                <div class="card-body" style="padding: 25px;">
                    <h3 style="color: #023e8a; font-weight: 800; margin: 0; font-size: 1.8rem;">
                        <i class="bi bi-database-fill"></i> Daftar Data Master
                    </h3>
                    <p class="text-muted mb-0" style="margin-top: 8px; font-size: 1.05rem;">
                        Kelola seluruh data master sistem untuk operasional rumah sakit hewan
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Master Cards -->
    <div class="row">
        <!-- Data User -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-info">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">User</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Data Pengguna Sistem</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z"></path>
                </svg>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Manajemen Role -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-success">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Role</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Manajemen Hak Akses</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.role-user.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Jenis Hewan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-warning">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Jenis Hewan</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0; color: #023e8a;">Kategori Jenis Hewan</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"></path>
                </svg>
                <a href="{{ route('admin.jenis-hewan.index') }}" class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover" style="color: #023e8a !important;">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Ras Hewan -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-danger">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Ras Hewan</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Data Ras Berdasarkan Jenis</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 00-.584.859 6.753 6.753 0 006.138 5.6 6.73 6.73 0 002.743 1.346A6.707 6.707 0 019.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 00-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 00.75-.75 2.25 2.25 0 00-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 01-1.112-3.173 6.73 6.73 0 002.743-1.347 6.753 6.753 0 006.139-5.6.75.75 0 00-.585-.858 47.077 47.077 0 00-3.07-.543V2.62a.75.75 0 00-.658-.744 49.22 49.22 0 00-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 00-.657.744zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 013.16 5.337a45.6 45.6 0 012.006-.343v.256zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 01-2.863 3.207 6.72 6.72 0 00.857-3.294z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.ras-hewan.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Pemilik -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-primary">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Pemilik</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Informasi Pemilik Hewan</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.pemilik.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Pet -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-secondary">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Pet</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Database Hewan Peliharaan</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M15.75 8.25a.75.75 0 01.75.75c0 1.12-.492 2.126-1.27 2.812a.75.75 0 11-.992-1.124A2.243 2.243 0 0015 9a.75.75 0 01.75-.75z"></path>
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM4.575 15.6a8.25 8.25 0 009.348 4.425 1.966 1.966 0 00-1.84-1.275.983.983 0 01-.97-.822l-.073-.437c-.094-.565.25-1.11.8-1.267l.99-.282c.427-.123.783-.418.982-.816l.036-.073a1.453 1.453 0 012.328-.377L16.5 15h.628a2.25 2.25 0 011.983 1.186 8.25 8.25 0 00-6.345-12.4c.044.262.18.503.389.676l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.575 15.6z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.pet.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Kategori -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box" style="background: linear-gradient(135deg, #6610f2, #520dc2); color: white;">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Kategori</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Kategori Layanan</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z"></path>
                </svg>
                <a href="{{ route('admin.kategori.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Data Kategori Klinis -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box" style="background: linear-gradient(135deg, #20c997, #17a689); color: white;">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Kategori Klinis</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Kategori Kondisi Medis</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 00-3 3v10.5a3 3 0 003 3h15a3 3 0 003-3V6.75a3 3 0 00-3-3h-15zm9 4.5a.75.75 0 00-1.5 0v5.69l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V8.25z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('admin.kategori-klinis.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>

        <!-- Kode Tindakan Terapi -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box" style="background: linear-gradient(135deg, #d63384, #a02669); color: white;">
                <div class="inner" style="padding: 25px;">
                    <h3 style="font-weight: 800; font-size: 2rem;">Tindakan Terapi</h3>
                    <p style="font-size: 1rem; margin: 10px 0 0;">Kode Tindakan Medis</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M11.644 1.59a.75.75 0 01.712 0l9.75 5.25a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.712 0l-9.75-5.25a.75.75 0 010-1.32l9.75-5.25z"></path>
                    <path d="M3.265 10.602l7.668 4.129a2.25 2.25 0 002.134 0l7.668-4.13 1.37.738a.75.75 0 010 1.32l-9.75 5.25a.75.75 0 01-.71 0l-9.75-5.25a.75.75 0 010-1.32l1.37-.738z"></path>
                    <path d="M10.933 19.231l-7.668-4.13-1.37.738a.75.75 0 000 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 000-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 01-2.134 0z"></path>
                </svg>
                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">
                    Kelola Data <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>
    </div>

    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
@endsection