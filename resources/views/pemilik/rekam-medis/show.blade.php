@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis - RSHP UNAIR')

@section('page-icon', 'file-medical-fill')
@section('page-title', 'Detail Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard-pemilik') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('pemilik.rekam-medis.index') }}">Rekam Medis</a></li>
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
            <!-- Rekam Medis Header Card -->
            <div class="header-card mb-4">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="bi bi-file-medical-fill"></i>
                    </div>
                    <div class="header-text">
                        <h1>Rekam Medis #{{ $rekamMedis->idrekam_medis }}</h1>
                        <p>Detail lengkap pemeriksaan dan perawatan hewan peliharaan</p>
                    </div>
                    <div class="header-badge">
                        <span class="badge-date">
                            <i class="bi bi-calendar"></i>
                            {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y') }}
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
                        <p>Data hewan yang diperiksa</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-tag"></i>
                                Nama Hewan
                            </div>
                            <div class="info-value">{{ $rekamMedis->pet ? $rekamMedis->pet->nama : 'Hewan Tidak Diketahui' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-list-ul"></i>
                                Jenis & Ras
                            </div>
                            <div class="info-value">
                                @if($rekamMedis->pet && $rekamMedis->pet->rasHewan && $rekamMedis->pet->rasHewan->jenisHewan)
                                    {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan }} - 
                                    {{ $rekamMedis->pet->rasHewan->nama_ras }}
                                @else
                                    Jenis & Ras Tidak Diketahui
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-gender-ambiguous"></i>
                                Jenis Kelamin
                            </div>
                            <div class="info-value">
                                @if($rekamMedis->pet && $rekamMedis->pet->jenis_kelamin == 'J') Jantan
                                @elseif($rekamMedis->pet && $rekamMedis->pet->jenis_kelamin == 'B') Betina
                                @else Tidak Diketahui
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-calendar"></i>
                                Usia
                            </div>
                            <div class="info-value">
                                @if($rekamMedis->pet && $rekamMedis->pet->tanggal_lahir)
                                    {{ \Carbon\Carbon::parse($rekamMedis->pet->tanggal_lahir)->age }} tahun
                                @else
                                    Tidak diketahui
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-palette"></i>
                                Warna/Tanda
                            </div>
                            <div class="info-value">{{ $rekamMedis->pet ? ($rekamMedis->pet->warna_tanda ?? 'Tidak ada') : 'Tidak diketahui' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">
                                <i class="bi bi-person"></i>
                                Pemilik
                            </div>
                            <div class="info-value">
                                @if($rekamMedis->pet && $rekamMedis->pet->pemilik && $rekamMedis->pet->pemilik->user)
                                    {{ $rekamMedis->pet->pemilik->user->nama }}
                                @else
                                    Pemilik Tidak Diketahui
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Medical Examination Card -->
            <div class="info-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-clipboard-check"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Pemeriksaan Medis</h5>
                        <p>Hasil pemeriksaan dan diagnosa</p>
                    </div>
                </div>
                <div class="card-body">
                    @if($rekamMedis->anamnesa)
                    <div class="section">
                        <h6>
                            <i class="bi bi-chat-left-text"></i>
                            Anamnesa
                        </h6>
                        <div class="section-content">
                            {{ $rekamMedis->anamnesa }}
                        </div>
                    </div>
                    @endif

                    @if($rekamMedis->temuan_klinis)
                    <div class="section">
                        <h6>
                            <i class="bi bi-search-heart"></i>
                            Temuan Klinis
                        </h6>
                        <div class="section-content">
                            {{ $rekamMedis->temuan_klinis }}
                        </div>
                    </div>
                    @endif

                    <div class="section">
                        <h6>
                            <i class="bi bi-clipboard-data"></i>
                            Diagnosa
                        </h6>
                        <div class="section-content diagnosa">
                            {{ $rekamMedis->diagnosa ?: 'Tidak ada diagnosa' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Treatments Card -->
            @if($rekamMedis->detailRekamMedis && $rekamMedis->detailRekamMedis->count() > 0)
            <div class="info-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-list-check"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Tindakan & Terapi</h5>
                        <p>Perawatan dan pengobatan yang diberikan</p>
                    </div>
                    <div class="card-header-badge">
                        <span class="badge-count">{{ $rekamMedis->detailRekamMedis->count() }} Tindakan</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="treatments-list">
                        @foreach($rekamMedis->detailRekamMedis as $detail)
                        <div class="treatment-item">
                            <div class="treatment-header">
                                <div class="treatment-code">
                                    {{ $detail->kodeTindakanTerapi ? $detail->kodeTindakanTerapi->kode : 'KODE' }}
                                </div>
                                <div class="treatment-category">
                                    @if($detail->kodeTindakanTerapi && $detail->kodeTindakanTerapi->kategori)
                                    <span class="category-badge">
                                        {{ $detail->kodeTindakanTerapi->kategori->nama_kategori }}
                                    </span>
                                    @endif
                                    @if($detail->kodeTindakanTerapi && $detail->kodeTindakanTerapi->kategoriKlinis)
                                    <span class="type-badge">
                                        {{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="treatment-body">
                                <h6>{{ $detail->kodeTindakanTerapi ? $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi : 'Tindakan tidak diketahui' }}</h6>
                                @if($detail->detail)
                                <p class="treatment-detail">{{ $detail->detail }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Doctor Info Card -->
            <div class="info-card sidebar-card mb-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Dokter Pemeriksa</h5>
                        <p>Informasi dokter yang menangani</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="doctor-profile">
                        <div class="doctor-avatar">
                            @if($rekamMedis->dokterPemeriksa && $rekamMedis->dokterPemeriksa->user)
                                {{ strtoupper(substr($rekamMedis->dokterPemeriksa->user->nama, 0, 1)) }}
                            @else
                                ?
                            @endif
                        </div>
                        <div class="doctor-info">
                            <h4>
                                @if($rekamMedis->dokterPemeriksa && $rekamMedis->dokterPemeriksa->user)
                                    {{ $rekamMedis->dokterPemeriksa->user->nama }}
                                @else
                                    Dokter Tidak Diketahui
                                @endif
                            </h4>
                            <p class="doctor-role">Dokter Hewan</p>
                            <div class="doctor-contact">
                                <div class="contact-item">
                                    <i class="bi bi-envelope"></i>
                                    <span>
                                        @if($rekamMedis->dokterPemeriksa && $rekamMedis->dokterPemeriksa->user)
                                            {{ $rekamMedis->dokterPemeriksa->user->email }}
                                        @else
                                            Email tidak tersedia
                                        @endif
                                    </span>
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
                        @if($rekamMedis->pet)
                        <a href="{{ route('pemilik.rekam-medis.index', $rekamMedis->pet->idpet) }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-file-medical"></i>
                            </div>
                            <div class="action-text">
                                <strong>Rekam Medis {{ $rekamMedis->pet->nama }}</strong>
                                <span>Lihat semua riwayat</span>
                            </div>
                            <div class="action-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>
                        @endif
                        <a href="{{ route('pemilik.pet.index') }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div class="action-text">
                                <strong>Data Hewan Saya</strong>
                                <span>Pantau data hewan peliharaan</span>
                            </div>
                            <div class="action-arrow">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </a>
                        <a href="{{ route('pemilik.reservasi.index') }}" class="quick-action">
                            <div class="action-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <div class="action-text">
                                <strong>Reservasi Saya</strong>
                                <span>Lihat jadwal kunjungan</span>
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
                        <i class="bi bi-info-circle"></i>
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
                                Tanggal Pemeriksaan
                            </div>
                            <div class="summary-value">
                                {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y H:i') }}
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-list-check"></i>
                                Total Tindakan
                            </div>
                            <div class="summary-value">
                                {{ $rekamMedis->detailRekamMedis ? $rekamMedis->detailRekamMedis->count() : 0 }} Tindakan
                            </div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">
                                <i class="bi bi-clock"></i>
                                Durasi
                            </div>
                            <div class="summary-value">
                                {{ \Carbon\Carbon::parse($rekamMedis->created_at)->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Button -->
    <div class="print-section mt-4">
        <div class="print-actions">
            <button class="btn-print" onclick="window.print()">
                <i class="bi bi-printer"></i>
                <span>Cetak Rekam Medis</span>
            </button>
            <a href="{{ route('pemilik.rekam-medis.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Kembali ke Daftar</span>
            </a>
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

        .card-header-badge {
            margin-left: auto;
        }

        .badge-count {
            background: rgba(255, 255, 255, 0.3);
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.8rem;
            backdrop-filter: blur(10px);
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

        /* Sections */
        .section {
            margin-bottom: 20px;
        }

        .section:last-child {
            margin-bottom: 0;
        }

        .section h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0 0 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-content {
            background: var(--light-bg);
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
            font-size: 0.95rem;
            line-height: 1.5;
            color: var(--text-dark);
        }

        .section-content.diagnosa {
            background: #fff8e6;
            border-left-color: #ffa500;
            font-weight: 600;
        }

        /* Treatments */
        .treatments-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .treatment-item {
            background: white;
            border: 2px solid #f8fbff;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .treatment-item:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.1);
        }

        .treatment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #f8fbff;
        }

        .treatment-code {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 800;
            font-size: 0.9rem;
        }

        .treatment-category {
            display: flex;
            gap: 8px;
        }

        .category-badge {
            background: #e3f2fd;
            color: var(--primary);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .type-badge {
            background: #e8f5e8;
            color: #06d6a0;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .treatment-body h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 8px 0;
        }

        .treatment-detail {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            padding: 10px;
            background: var(--light-bg);
            border-radius: 6px;
            border-left: 3px solid #ffa500;
        }

        /* Sidebar Cards */
        .sidebar-card {
            margin-bottom: 20px;
        }

        .sidebar-card:last-child {
            margin-bottom: 0;
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

        /* Print Section */
        .print-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.1);
            border: 2px solid #f8fbff;
        }

        .print-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
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

        /* Print Styles */
        @media print {
            .navbar, .sidebar, .breadcrumb, .print-section {
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

            .treatment-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .print-actions {
                flex-direction: column;
            }

            .btn-print, .btn-back {
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
        // Add any additional JavaScript functionality here
        console.log('Rekam Medis Detail Loaded');

        // Smooth scroll to sections
        function scrollToSection(sectionId) {
            const element = document.getElementById(sectionId);
            if (element) {
                element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Copy to clipboard functionality
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
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
                            <p>Data berhasil disalin ke clipboard</p>
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