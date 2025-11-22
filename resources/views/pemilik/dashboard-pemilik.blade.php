@extends('layouts.lte.main')

@section('title', 'Dashboard Pemilik - RSHP UNAIR')

@section('page-icon', 'house-heart-fill')
@section('page-title', 'Dashboard Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Alert Success -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div class="alert-text">
                    <strong>Berhasil!</strong>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="alert-content">
                <div class="alert-icon">
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div>
                <div class="alert-text">
                    <strong>Error!</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Welcome Card -->
    <div class="welcome-card mb-4">
        <div class="welcome-content">
            <div class="welcome-icon">
                👨
            </div>
            <div class="welcome-text">
                <h1>Selamat Datang, {{ $pemilik->nama ?? Auth::user()->nama }}!</h1>
                <p>Anda login sebagai <strong>Pemilik Hewan</strong><br>
                Kelola informasi hewan peliharaan, reservasi, dan rekam medis di RSHP Universitas Airlangga</p>
                <span class="role-badge">
                    <span>✨</span>
                    <span>PEMILIK HEWAN</span>
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
                    <p>{{ now()->format('d M Y') }}</p>
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
                    <p>Pemilik Hewan</p>
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
                    <p>View Only</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalPets }}</h3>
                    <p>Total Hewan Peliharaan</p>
                    <a href="{{ route('pemilik.pet.index') }}" class="stat-link">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalReservasi }}</h3>
                    <p>Total Reservasi</p>
                    <a href="{{ route('pemilik.reservasi.index') }}" class="stat-link">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffa500, #ff8c00);">
                    <i class="bi bi-file-medical"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $totalRekamMedis }}</h3>
                    <p>Total Rekam Medis</p>
                    <a href="{{ route('pemilik.rekam-medis.index') }}" class="stat-link">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Reservasi Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card recent-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Reservasi Terbaru</h5>
                        <p>5 reservasi terakhir</p>
                    </div>
                    <a href="{{ route('pemilik.reservasi.index') }}" class="header-link">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if($reservasiTerbaru->count() > 0)
                        <div class="recent-list">
                            @foreach($reservasiTerbaru as $reservasi)
                            <div class="recent-item">
                                <div class="recent-icon">
                                    @if(str_contains($reservasi->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Anjing'))
                                        🐕
                                    @elseif(str_contains($reservasi->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kucing'))
                                        🐈
                                    @elseif(str_contains($reservasi->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Burung'))
                                        🐦
                                    @elseif(str_contains($reservasi->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kelinci'))
                                        🐇
                                    @else
                                        🐾
                                    @endif
                                </div>
                                <div class="recent-content">
                                    <h6>{{ $reservasi->pet->nama }}</h6>
                                    <p>{{ $reservasi->pet->rasHewan->jenisHewan->nama_jenis_hewan }} - {{ $reservasi->pet->rasHewan->nama_ras }}</p>
                                    <small>{{ $reservasi->waktu_daftar->format('d M Y H:i') }}</small>
                                </div>
                                <div class="recent-status">
                                    <span class="status-badge status-{{ strtolower($reservasi->status) }}">
                                        {{ $reservasi->status == 'P' ? 'Pending' : ($reservasi->status == 'S' ? 'Selesai' : 'Dibatalkan') }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-recent">
                            <i class="bi bi-calendar-x"></i>
                            <p>Belum ada reservasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Rekam Medis Terbaru -->
        <div class="col-lg-6 mb-4">
            <div class="card recent-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-file-medical"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Rekam Medis Terbaru</h5>
                        <p>5 rekam medis terakhir</p>
                    </div>
                    <a href="{{ route('pemilik.rekam-medis.index') }}" class="header-link">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if($rekamMedisTerbaru->count() > 0)
                        <div class="recent-list">
                            @foreach($rekamMedisTerbaru as $rekam)
                            <div class="recent-item">
                                <div class="recent-icon">
                                    @if(str_contains($rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Anjing'))
                                        🐕
                                    @elseif(str_contains($rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kucing'))
                                        🐈
                                    @elseif(str_contains($rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Burung'))
                                        🐦
                                    @elseif(str_contains($rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kelinci'))
                                        🐇
                                    @else
                                        🐾
                                    @endif
                                </div>
                                <div class="recent-content">
                                    <h6>{{ $rekam->pet->nama }}</h6>
                                    <p>{{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan }}</p>
                                    <small>{{ $rekam->created_at->format('d M Y H:i') }}</small>
                                </div>
                                <div class="recent-action">
                                    <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" 
                                       class="btn-view-small">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-recent">
                            <i class="bi bi-file-medical"></i>
                            <p>Belum ada rekam medis</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #0096c7;
            --success: #06d6a0;
            --warning: #ffa500;
            --danger: #ef476f;
            --light-bg: #f8fbff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

        /* Alert Styles */
        .alert-success {
            background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(5, 181, 137, 0.1));
            border: 2px solid var(--success);
            border-radius: 15px;
            padding: 0;
            animation: slideDown 0.5s ease;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 71, 111, 0.1), rgba(214, 40, 57, 0.1));
            border: 2px solid var(--danger);
            border-radius: 15px;
            padding: 0;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 18px 20px;
        }

        .alert-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .alert-success .alert-icon {
            background: linear-gradient(135deg, var(--success), #05b589);
        }

        .alert-danger .alert-icon {
            background: linear-gradient(135deg, var(--danger), #d62839);
        }

        .alert-text strong {
            font-size: 1rem;
            display: block;
            margin-bottom: 3px;
        }

        .alert-success .alert-text strong {
            color: var(--success);
        }

        .alert-danger .alert-text strong {
            color: var(--danger);
        }

        .alert-text p {
            color: var(--text-gray);
            margin: 0;
            font-size: 0.9rem;
        }

        .alert .btn-close {
            padding: 20px;
        }

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

        /* Stat Cards */
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 119, 182, 0.2);
            border-color: #0077b6;
        }

        .stat-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            flex-shrink: 0;
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
        }

        .stat-content h3 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #023e8a;
            margin: 0 0 5px 0;
            line-height: 1;
        }

        .stat-content p {
            font-size: 1rem;
            color: var(--text-gray);
            margin: 0 0 15px 0;
            font-weight: 600;
        }

        .stat-link {
            color: #0077b6;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .stat-link:hover {
            color: #023e8a;
            transform: translateX(5px);
        }

        /* Recent Cards */
        .recent-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
        }

        .recent-card .card-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 25px 30px;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .card-header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .card-header-text h5 {
            margin: 0 0 5px 0;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .card-header-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .header-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .header-link:hover {
            color: rgba(255, 255, 255, 0.8);
            transform: translateX(3px);
        }

        .recent-card .card-body {
            padding: 25px;
        }

        .recent-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .recent-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: var(--light-bg);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .recent-item:hover {
            background: #e8f1fa;
            transform: translateX(5px);
        }

        .recent-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .recent-content {
            flex: 1;
        }

        .recent-content h6 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .recent-content p {
            margin: 0 0 5px 0;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .recent-content small {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 600;
        }

        .recent-status {
            flex-shrink: 0;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-selesai {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        .status-dibatalkan {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .recent-action {
            flex-shrink: 0;
        }

        .btn-view-small {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view-small:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .empty-recent {
            text-align: center;
            padding: 40px 20px;
            color: var(--text-gray);
        }

        .empty-recent i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-recent p {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-content {
                flex-direction: column;
                text-align: center;
            }

            .welcome-text h1 {
                font-size: 1.8rem;
            }

            .stat-card {
                flex-direction: column;
                text-align: center;
            }

            .recent-card .card-header {
                flex-direction: column;
                text-align: center;
            }

            .recent-item {
                flex-direction: column;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .welcome-card {
                padding: 30px 25px;
            }

            .stat-content h3 {
                font-size: 2rem;
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