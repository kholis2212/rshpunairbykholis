{{-- views/admin/dashboard-admin.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Dashboard Admin - RSHP UNAIR')

@section('page-icon', 'house-heart-fill')
@section('page-title', 'Dashboard Administrator')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Alert Success -->
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: flex; align-items: center; gap: 15px; border-radius: 15px; border: none; box-shadow: 0 8px 25px rgba(6, 214, 160, 0.3);">
            <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
            <span style="font-weight: 600;">{{ session('status') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="welcome-content">
            <div class="welcome-icon">
                👨‍💼
            </div>
            <div class="welcome-text">
                <h1>Selamat Datang, {{ Auth::user()->nama }}!</h1>
                <p>Anda login sebagai <strong>Administrator</strong><br>
                Kelola seluruh sistem dan data master RSHP Universitas Airlangga dengan akses penuh</p>
                <span class="role-badge">
                    <span>✨</span>
                    <span>ADMINISTRATOR</span>
                </span>
            </div>
        </div>
    </div>

    <!-- System Info Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                    📅
                </div>
                <div class="info-content">
                    <h6>Hari Ini</h6>
                    <p>{{ now()->format('d F Y') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                    ⏰
                </div>
                <div class="info-content">
                    <h6>Waktu</h6>
                    <p id="current-time">{{ now()->format('H:i:s') }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #0077b6, #023e8a);">
                    👤
                </div>
                <div class="info-content">
                    <h6>Status</h6>
                    <p>Administrator</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #0077b6, #005f8f);">
                    🔐
                </div>
                <div class="info-content">
                    <h6>Akses</h6>
                    <p>Full Control</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Header -->
    <div class="section-header">
        <h2>
            <span>🗂️</span>
            <span>Daftar Data Master</span>
        </h2>
        <p>Kelola seluruh data master sistem untuk operasional rumah sakit hewan</p>
    </div>

    <!-- Data Master Grid -->
    <div class="data-master-grid">
        <!-- Data User -->
        <a href="{{ route('admin.user.index') }}" class="master-card">
            <div class="master-icon">👥</div>
            <h3>Data User</h3>
            <p>Kelola akun pengguna sistem, termasuk admin, dokter, perawat, resepsionis, dan pemilik</p>
        </a>

        <!-- Manajemen Role -->
        <a href="{{ route('admin.role-user.index') }}" class="master-card">
            <div class="master-icon">🔐</div>
            <h3>Manajemen Role</h3>
            <p>Atur hak akses dan peran pengguna dalam sistem manajemen rumah sakit</p>
        </a>

        <!-- Data Jenis Hewan -->
        <a href="{{ route('admin.jenis-hewan.index') }}" class="master-card">
            <div class="master-icon">🐾</div>
            <h3>Data Jenis Hewan</h3>
            <p>Kelola kategori jenis hewan seperti anjing, kucing, burung, dan lainnya</p>
        </a>

        <!-- Data Ras Hewan -->
        <a href="{{ route('admin.ras-hewan.index') }}" class="master-card">
            <div class="master-icon">🐕</div>
            <h3>Data Ras Hewan</h3>
            <p>Kelola data ras hewan berdasarkan jenis untuk identifikasi yang lebih spesifik</p>
        </a>

        <!-- Data Pemilik -->
        <a href="{{ route('admin.pemilik.index') }}" class="master-card">
            <div class="master-icon">👤</div>
            <h3>Data Pemilik</h3>
            <p>Kelola informasi pemilik hewan, kontak, dan data registrasi pelanggan</p>
        </a>

        <!-- Data Pet -->
        <a href="{{ route('admin.pet.index') }}" class="master-card">
            <div class="master-icon">🐶</div>
            <h3>Data Pet</h3>
            <p>Kelola database hewan peliharaan pasien dengan profil lengkap</p>
        </a>

        <!-- Data Kategori -->
        <a href="{{ route('admin.kategori.index') }}" class="master-card">
            <div class="master-icon">📁</div>
            <h3>Data Kategori</h3>
            <p>Kelola kategori layanan dan klasifikasi untuk organisasi data</p>
        </a>

        <!-- Data Kategori Klinis -->
        <a href="{{ route('admin.kategori-klinis.index') }}" class="master-card">
            <div class="master-icon">🏥</div>
            <h3>Data Kategori Klinis</h3>
            <p>Kelola kategori kondisi klinis dan diagnosis medis hewan</p>
        </a>

        <!-- Data Kode Tindakan Terapi -->
        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="master-card">
            <div class="master-icon">💉</div>
            <h3>Kode Tindakan Terapi</h3>
            <p>Kelola kode dan jenis tindakan medis serta terapi untuk hewan</p>
        </a>
    </div>

    <style>
        /* Welcome Card */
        .welcome-card {
            background: var(--white);
            border-radius: 25px;
            padding: 45px;
            box-shadow: 0 20px 60px rgba(0, 119, 182, 0.2);
            position: relative;
            overflow: hidden;
            border: 3px solid transparent;
            background-clip: padding-box;
        }

        .welcome-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 25px;
            padding: 3px;
            background: linear-gradient(135deg, #0077b6, #0096c7, #00b4d8);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
        }

        .welcome-card::after {
            content: "";
            position: absolute;
            top: -100px;
            right: -100px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.15), rgba(0, 150, 199, 0.15));
            border-radius: 50%;
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.6;
            }
            50% {
                transform: scale(1.1);
                opacity: 0.4;
            }
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .welcome-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            flex-shrink: 0;
            box-shadow: 0 10px 30px rgba(0, 119, 182, 0.4);
            animation: bounce 2s ease-in-out infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .welcome-text h1 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #023e8a, #0077b6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-text p {
            font-size: 1.1rem;
            color: var(--text-gray);
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.4);
        }

        /* Info Cards */
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.12);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 119, 182, 0.2);
            border-color: #0077b6;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .info-content h6 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-gray);
            margin: 0 0 5px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-content p {
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0;
        }

        /* Section Header */
        .section-header {
            margin-bottom: 35px;
            text-align: center;
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.1);
            border: 2px solid rgba(0, 119, 182, 0.1);
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #023e8a;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .section-header p {
            color: var(--text-gray);
            font-size: 1.05rem;
            font-weight: 500;
            margin: 0;
        }

        /* Data Master Grid */
        .data-master-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        /* Master Card */
        .master-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            text-decoration: none;
            color: var(--text-dark);
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            border: 2px solid transparent;
        }

        .master-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #0077b6, #0096c7, #00b4d8);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .master-card::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(0, 119, 182, 0.1), transparent);
            border-radius: 50%;
            transition: width 0.5s ease, height 0.5s ease;
        }

        .master-card:hover::before {
            transform: scaleX(1);
        }

        .master-card:hover::after {
            width: 400px;
            height: 400px;
        }

        .master-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 119, 182, 0.25);
            border-color: #0077b6;
        }

        .master-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.35);
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }

        .master-card:hover .master-icon {
            transform: scale(1.15) rotate(5deg);
            box-shadow: 0 12px 35px rgba(0, 119, 182, 0.5);
            background: linear-gradient(135deg, #005f8f, #0077b6);
        }

        .master-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .master-card:hover h3 {
            color: #0077b6;
        }

        .master-card p {
            font-size: 0.85rem;
            color: var(--text-gray);
            line-height: 1.6;
            position: relative;
            z-index: 2;
            margin-bottom: 0;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .data-master-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .welcome-content {
                flex-direction: column;
                text-align: center;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .data-master-grid {
                grid-template-columns: 1fr;
            }

            .section-header h2 {
                font-size: 1.6rem;
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .welcome-card {
                padding: 30px 25px;
            }

            .section-header h2 {
                font-size: 1.4rem;
            }

            .master-card {
                padding: 25px 20px;
            }
        }
    </style>

@endsection

@section('extra-js')
    <script>
        // Update current time every second
        setInterval(function() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const timeElement = document.getElementById('current-time');
            if (timeElement) {
                timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }, 1000);
    </script>
@endsection