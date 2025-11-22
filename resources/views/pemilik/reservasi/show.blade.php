@extends('layouts.lte.main')

@section('title', 'Detail Reservasi - RSHP UNAIR')

@section('page-icon', 'calendar-check-fill')
@section('page-title', 'Detail Reservasi Temu Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard-pemilik') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pemilik.reservasi.index') }}">Reservasi Saya</a></li>
    <li class="breadcrumb-item active">Detail</li>
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

    <div class="row">
        <div class="col-lg-8">
            <!-- Reservasi Header Card -->
            <div class="header-card mb-4">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="header-text">
                        <h1>Reservasi #{{ $reservasi->idreservasi_dokter }}</h1>
                        <p>Detail lengkap janji temu dokter hewan</p>
                    </div>
                    <div class="header-badge">
                        <span class="badge-date">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($reservasi->waktu_daftar)->format('d M Y') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Patient Info Card -->
            <div class="info-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-heart-pulse"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Informasi Pasien</h5>
                        <p>Data hewan yang akan diperiksa</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-tag"></i>
                                Nama Hewan
                            </div>
                            <div class="info-value">{{ $reservasi->nama_pet }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-list-ul"></i>
                                Jenis & Ras
                            </div>
                            <div class="info-value">
                                {{ $reservasi->nama_jenis_hewan }} - {{ $reservasi->nama_ras }}
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-gender-ambiguous"></i>
                                Jenis Kelamin
                            </div>
                            <div class="info-value">
                                @if($reservasi->jenis_kelamin == 'J') Jantan
                                @elseif($reservasi->jenis_kelamin == 'B') Betina
                                @else Tidak Diketahui
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-palette"></i>
                                Warna/Tanda
                            </div>
                            <div class="info-value">{{ $reservasi->warna_tanda ?? 'Tidak ada' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-calendar"></i>
                                Usia
                            </div>
                            <div class="info-value">
                                @if($reservasi->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($reservasi->tanggal_lahir)->age }} tahun
                                @else
                                    Tidak diketahui
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-person"></i>
                                Pemilik
                            </div>
                            <div class="info-value">{{ $reservasi->nama_pemilik }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reservasi Details Card -->
            <div class="info-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-calendar-event"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Detail Reservasi</h5>
                        <p>Informasi jadwal dan status</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-hash"></i>
                                Nomor Antrian
                            </div>
                            <div class="info-value">
                                <span class="antrian-number-large">#{{ $reservasi->no_urut }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-calendar-date"></i>
                                Tanggal Reservasi
                            </div>
                            <div class="info-value">{{ $reservasi->tanggal_daftar }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-clock"></i>
                                Waktu Reservasi
                            </div>
                            <div class="info-value">{{ $reservasi->jam_daftar }} WIB</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-person-badge"></i>
                                Dokter Penanggung Jawab
                            </div>
                            <div class="info-value">{{ $reservasi->nama_dokter ?? 'Belum Ditentukan' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-info-circle"></i>
                                Status
                            </div>
                            <div class="info-value">
                                @php
                                    $statusColor = $reservasi->status == 'P' ? 'warning' : 
                                                 ($reservasi->status == 'S' ? 'success' : 'danger');
                                    $statusText = $reservasi->status == 'P' ? 'Menunggu' : 
                                                ($reservasi->status == 'S' ? 'Selesai' : 'Dibatalkan');
                                @endphp
                                <span class="status-badge status-{{ $statusColor }}">
                                    <i class="bi bi-circle-fill"></i>
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-clock-history"></i>
                                Waktu Pendaftaran
                            </div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($reservasi->waktu_daftar)->format('d M Y H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            @if($reservasi->keluhan)
            <div class="info-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Keluhan</h5>
                        <p>Informasi keluhan yang dilaporkan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="section-content">
                        {{ $reservasi->keluhan }}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Status Info Card -->
            <div class="info-card sidebar-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Status Reservasi</h5>
                        <p>Informasi terkini</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="status-display">
                        @if($reservasi->status == 'P')
                        <div class="status-waiting">
                            <div class="status-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="status-content">
                                <h4>Menunggu Antrian</h4>
                                <p>Nomor antrian Anda: <strong>#{{ $reservasi->no_urut }}</strong></p>
                                <div class="status-instruction">
                                    <i class="bi bi-info-circle"></i>
                                    <span>Silakan datang sesuai jadwal dan tunggu panggilan</span>
                                </div>
                            </div>
                        </div>
                        @elseif($reservasi->status == 'S')
                        <div class="status-completed">
                            <div class="status-icon">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="status-content">
                                <h4>Reservasi Selesai</h4>
                                <p>Pemeriksaan telah dilaksanakan</p>
                                <div class="status-instruction">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Terima kasih telah menggunakan layanan RSHP UNAIR</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="status-cancelled">
                            <div class="status-icon">
                                <i class="bi bi-x-circle"></i>
                            </div>
                            <div class="status-content">
                                <h4>Reservasi Dibatalkan</h4>
                                <p>Reservasi ini telah dibatalkan</p>
                                <div class="status-instruction">
                                    <i class="bi bi-info-circle"></i>
                                    <span>Hubungi resepsionis untuk informasi lebih lanjut</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Doctor Info Card -->
            <div class="info-card sidebar-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Dokter Penanggung Jawab</h5>
                        <p>Informasi dokter</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="doctor-profile">
                        <div class="doctor-avatar">
                            @if($reservasi->nama_dokter)
                                {{ strtoupper(substr($reservasi->nama_dokter, 0, 1)) }}
                            @else
                                ?
                            @endif
                        </div>
                        <div class="doctor-info">
                            <h4>{{ $reservasi->nama_dokter ?? 'Belum Ditentukan' }}</h4>
                            <p class="doctor-role">Dokter Hewan</p>
                            <div class="doctor-contact">
                                <div class="contact-item">
                                    <i class="bi bi-hospital"></i>
                                    <span>RSHP UNAIR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="info-card sidebar-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-lightning"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Akses Cepat</h5>
                        <p>Navigasi terkait</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="{{ route('pemilik.reservasi.index') }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-list-ul"></i>
                            </div>
                            <div class="action-text">
                                <strong>Semua Reservasi</strong>
                                <span>Lihat daftar reservasi</span>
                            </div>
                            <div class="action-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>
                        <a href="{{ route('pemilik.pet.index') }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div class="action-text">
                                <strong>Data Hewan Saya</strong>
                                <span>Kelola data hewan</span>
                            </div>
                            <div class="action-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>
                        <a href="{{ route('pemilik.dashboard-pemilik') }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-house"></i>
                            </div>
                            <div class="action-text">
                                <strong>Dashboard</strong>
                                <span>Kembali ke beranda</span>
                            </div>
                            <div class="action-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="info-card sidebar-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-card-checklist"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Ringkasan</h5>
                        <p>Informasi singkat</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary-list">
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-calendar"></i>
                                Tanggal Reservasi
                            </div>
                            <div class="summary-value">
                                {{ $reservasi->tanggal_daftar }}
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-clock"></i>
                                Waktu
                            </div>
                            <div class="summary-value">
                                {{ $reservasi->jam_daftar }} WIB
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-hash"></i>
                                No Antrian
                            </div>
                            <div class="summary-value">
                                #{{ $reservasi->no_urut }}
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-clock-history"></i>
                                Durasi
                            </div>
                            <div class="summary-value">
                                {{ \Carbon\Carbon::parse($reservasi->waktu_daftar)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-section mt-4">
        <div class="action-buttons">
            <a href="{{ route('pemilik.reservasi.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar</span>
            </a>
            @if($reservasi->status == 'P')
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer"></i>
                <span>Cetak Reservasi</span>
            </button>
            @endif
        </div>
    </div>

    <style>
        /* Header Card */
        .header-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            border: 2px solid #f8fbff;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            flex-shrink: 0;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0 0 5px 0;
        }

        .header-text p {
            color: var(--text-gray);
            font-size: 1rem;
            margin: 0;
        }

        .badge-date {
            background: linear-gradient(135deg, #06d6a0, #05b589);
            color: white;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Info Card */
        .info-card {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.1);
            border: 2px solid #f8fbff;
            overflow: hidden;
        }

        .info-card .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px 25px;
            border: none;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-header-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            backdrop-filter: blur(10px);
        }

        .card-header-text h5 {
            margin: 0 0 3px 0;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .card-header-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .info-card .card-body {
            padding: 25px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-gray);
        }

        .info-label i {
            color: var(--primary);
            font-size: 1rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            padding: 8px 12px;
            background: var(--light-bg);
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }

        .antrian-number-large {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            border: 2px solid var(--primary);
        }

        /* Status Badge */
        .status-badge {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .status-warning {
            background: rgba(255, 165, 0, 0.1);
            color: #ff8c00;
            border: 1px solid rgba(255, 165, 0, 0.3);
        }

        .status-success {
            background: rgba(6, 214, 160, 0.1);
            color: #05b589;
            border: 1px solid rgba(6, 214, 160, 0.3);
        }

        .status-danger {
            background: rgba(239, 71, 111, 0.1);
            color: #d62839;
            border: 1px solid rgba(239, 71, 111, 0.3);
        }

        /* Section Content */
        .section-content {
            background: var(--light-bg);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid var(--primary);
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Sidebar Cards */
        .sidebar-card {
            margin-bottom: 20px;
        }

        .sidebar-card:last-child {
            margin-bottom: 0;
        }

        /* Status Display */
        .status-display {
            text-align: center;
        }

        .status-waiting, .status-completed, .status-cancelled {
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .status-waiting {
            background: linear-gradient(135deg, #fff8e6, #fffbeb);
            border: 2px solid #ffa500;
        }

        .status-completed {
            background: linear-gradient(135deg, #e8f5e8, #f0f9f0);
            border: 2px solid #06d6a0;
        }

        .status-cancelled {
            background: linear-gradient(135deg, #ffe6e6, #ffebeb);
            border: 2px solid #ef476f;
        }

        .status-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 15px;
        }

        .status-waiting .status-icon {
            background: #ffa500;
            color: white;
        }

        .status-completed .status-icon {
            background: #06d6a0;
            color: white;
        }

        .status-cancelled .status-icon {
            background: #ef476f;
            color: white;
        }

        .status-content h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .status-content p {
            color: var(--text-gray);
            margin: 0 0 15px 0;
        }

        .status-instruction {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        /* Doctor Profile */
        .doctor-profile {
            text-align: center;
        }

        .doctor-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 800;
            margin: 0 auto 15px;
            box-shadow: 0 5px 15px rgba(6, 214, 160, 0.3);
        }

        .doctor-info h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0 0 5px 0;
        }

        .doctor-role {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin: 0 0 15px 0;
            font-weight: 600;
        }

        .doctor-contact {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .contact-item i {
            color: var(--primary);
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .quick-action {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: var(--light-bg);
            border-radius: 10px;
            text-decoration: none;
            color: var(--text-dark);
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .quick-action:hover {
            background: white;
            border-color: var(--primary);
            transform: translateX(5px);
        }

        .action-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .action-text {
            flex: 1;
        }

        .action-text strong {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: block;
            margin-bottom: 2px;
        }

        .action-text span {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .action-arrow {
            color: var(--primary);
            font-size: 1.1rem;
        }

        /* Summary */
        .summary-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f8fbff;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-gray);
        }

        .summary-label i {
            color: var(--primary);
        }

        .summary-value {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Action Section */
        .action-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.1);
            border: 2px solid #f8fbff;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-back {
            background: var(--light-bg);
            color: var(--text-gray);
            border: 2px solid #e8e8e8;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: var(--text-dark);
        }

        .btn-print {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        /* Print Styles */
        @media print {
            .navbar, .sidebar, .breadcrumb, .action-section {
                display: none !important;
            }
            
            .header-card, .info-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
                break-inside: avoid;
            }
            
            .card-header {
                background: #f8f9fa !important;
                color: #000 !important;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-back, .btn-print {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .header-text h1 {
                font-size: 1.6rem;
            }

            .card-body {
                padding: 20px;
            }

            .quick-action {
                flex-direction: column;
                text-align: center;
            }

            .action-text {
                text-align: center;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        console.log('Reservasi Detail Loaded');

        // Add any additional JavaScript functionality here
        function copyReservasiInfo() {
            const reservasiInfo = `
Reservasi RSHP UNAIR
Nomor: #{{ $reservasi->idreservasi_dokter }}
Hewan: {{ $reservasi->nama_pet }}
Tanggal: {{ $reservasi->tanggal_daftar }}
Waktu: {{ $reservasi->jam_daftar }} WIB
No Antrian: #{{ $reservasi->no_urut }}
            `.trim();

            navigator.clipboard.writeText(reservasiInfo).then(() => {
                // Show success message
                const toast = document.createElement('div');
                toast.className = 'alert alert-success';
                toast.innerHTML = `
                    <div class="alert-content">
                        <div class="alert-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="alert-text">
                            <strong>Berhasil!</strong>
                            <p>Informasi reservasi berhasil disalin</p>
                        </div>
                    </div>
                `;
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        }

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection