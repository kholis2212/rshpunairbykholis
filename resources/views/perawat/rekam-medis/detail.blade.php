@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis - RSHP UNAIR')

@section('page-icon', 'file-medical-fill')
@section('page-title', 'Detail Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard-perawat') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekam-medis.index') }}">Daftar Rekam Medis</a></li>
    <li class="breadcrumb-item active">Detail Rekam Medis</li>
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
        <!-- Informasi Pasien -->
        <div class="col-lg-4 mb-4">
            <div class="card patient-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Informasi Pasien</h5>
                        <p>Data lengkap hewan pasien</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="patient-avatar">
                        @if(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Anjing'))
                            🐕
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kucing'))
                            🐈
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Burung'))
                            🐦
                        @elseif(str_contains($rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan, 'Kelinci'))
                            🐇
                        @else
                            🐾
                        @endif
                    </div>
                    <div class="patient-info">
                        <h4>{{ $rekamMedis->pet->nama }}</h4>
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="bi bi-tags-fill"></i>
                                <div class="info-content">
                                    <span class="info-label">Jenis/Ras</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan }} / 
                                        {{ $rekamMedis->pet->rasHewan->nama_ras }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-gender-ambiguous"></i>
                                <div class="info-content">
                                    <span class="info-label">Jenis Kelamin</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-calendar-event-fill"></i>
                                <div class="info-content">
                                    <span class="info-label">Tanggal Lahir</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->tanggal_lahir ? \Carbon\Carbon::parse($rekamMedis->pet->tanggal_lahir)->format('d M Y') : '-' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-palette-fill"></i>
                                <div class="info-content">
                                    <span class="info-label">Warna/Tanda</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->warna_tanda ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Pemilik -->
            <div class="card owner-card mt-4">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Informasi Pemilik</h5>
                        <p>Data kontak pemilik hewan</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="owner-info">
                        <h5>{{ $rekamMedis->pet->pemilik->user->nama }}</h5>
                        <div class="info-grid">
                            <div class="info-item">
                                <i class="bi bi-telephone-fill"></i>
                                <div class="info-content">
                                    <span class="info-label">No. WhatsApp</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->pemilik->no_wa ?? '-' }}
                                    </span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <div class="info-content">
                                    <span class="info-label">Alamat</span>
                                    <span class="info-value">
                                        {{ $rekamMedis->pet->pemilik->alamat ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Rekam Medis -->
        <div class="col-lg-8">
            <!-- Rekam Medis Utama -->
            <div class="card medical-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-clipboard2-pulse-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Rekam Medis</h5>
                        <p>Data pemeriksaan dan diagnosis</p>
                    </div>
                    <div class="card-header-badge">
                        <span class="badge-date">
                            {{ $rekamMedis->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="medical-sections">
                        <!-- Anamnesa -->
                        <div class="medical-section">
                            <div class="section-header">
                                <i class="bi bi-chat-left-text-fill"></i>
                                <h6>Anamnesa</h6>
                            </div>
                            <div class="section-content">
                                @if($rekamMedis->anamnesa)
                                    <p>{{ $rekamMedis->anamnesa }}</p>
                                @else
                                    <p class="text-muted">Tidak ada data anamnesa</p>
                                @endif
                            </div>
                        </div>

                        <!-- Temuan Klinis -->
                        <div class="medical-section">
                            <div class="section-header">
                                <i class="bi bi-clipboard-check-fill"></i>
                                <h6>Temuan Klinis</h6>
                            </div>
                            <div class="section-content">
                                @if($rekamMedis->temuan_klinis)
                                    <p>{{ $rekamMedis->temuan_klinis }}</p>
                                @else
                                    <p class="text-muted">Tidak ada data temuan klinis</p>
                                @endif
                            </div>
                        </div>

                        <!-- Diagnosa -->
                        <div class="medical-section">
                            <div class="section-header">
                                <i class="bi bi-file-medical-fill"></i>
                                <h6>Diagnosa</h6>
                            </div>
                            <div class="section-content">
                                @if($rekamMedis->diagnosa)
                                    <div class="diagnosa-box">
                                        <p>{{ $rekamMedis->diagnosa }}</p>
                                    </div>
                                @else
                                    <p class="text-muted">Tidak ada data diagnosa</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Tindakan & Terapi -->
            <div class="card treatment-card mt-4">
                <div class="card-header">
                    <div class="card-header-left">
                        <div class="card-header-icon">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                        <div class="card-header-text">
                            <h5>Tindakan & Terapi</h5>
                            <p>Detail penanganan medis yang diberikan</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($rekamMedis->detailRekamMedis->count() > 0)
                        <div class="treatments-list">
                            @foreach($rekamMedis->detailRekamMedis as $detail)
                            <div class="treatment-item">
                                <div class="treatment-header">
                                    <div class="treatment-code">
                                        <span class="code-badge">
                                            {{ $detail->kodeTindakanTerapi->kode }}
                                        </span>
                                        <span class="treatment-name">
                                            {{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi }}
                                        </span>
                                    </div>
                                </div>
                                <div class="treatment-category">
                                    <span class="category-badge">
                                        <i class="bi bi-tag-fill"></i>
                                        {{ $detail->kodeTindakanTerapi->kategori->nama_kategori }}
                                    </span>
                                    <span class="type-badge">
                                        <i class="bi bi-clipboard2-pulse-fill"></i>
                                        {{ $detail->kodeTindakanTerapi->kategoriKlinis->nama_kategori_klinis }}
                                    </span>
                                </div>
                                <div class="treatment-detail">
                                    <p>{{ $detail->detail }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-treatments">
                            <div class="empty-icon">
                                <i class="bi bi-heartbreak"></i>
                            </div>
                            <h6>Belum Ada Tindakan</h6>
                            <p>Belum ada tindakan atau terapi yang dicatat untuk rekam medis ini</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons-card mt-4">
                <div class="action-buttons-grid">
                    <a href="{{ route('perawat.rekam-medis.edit', $rekamMedis->idrekam_medis) }}" class="btn-action btn-edit">
                        <i class="bi bi-pencil-square"></i>
                        <span>Edit Rekam Medis</span>
                    </a>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn-action btn-back">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
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

        /* Alert Success */
        .alert-success {
            background: linear-gradient(135deg, rgba(6, 214, 160, 0.1), rgba(5, 181, 137, 0.1));
            border: 2px solid var(--success);
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
            background: linear-gradient(135deg, var(--success), #05b589);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .alert-text strong {
            color: var(--success);
            font-size: 1rem;
            display: block;
            margin-bottom: 3px;
        }

        .alert-text p {
            color: var(--text-gray);
            margin: 0;
            font-size: 0.9rem;
        }

        .alert .btn-close {
            padding: 20px;
        }

        /* Card Styles */
        .patient-card,
        .owner-card,
        .medical-card,
        .treatment-card,
        .action-buttons-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 25px 30px;
            border: none;
            display: flex;
            align-items: center;
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
            font-size: 1.3rem;
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

        .badge-date {
            background: rgba(255, 255, 255, 0.3);
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 15px;
            flex: 1;
        }

        .card-body {
            padding: 30px;
        }

        /* Patient Card */
        .patient-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 25px;
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.3);
        }

        .patient-info h4 {
            text-align: center;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 25px;
            font-size: 1.5rem;
        }

        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: start;
            gap: 15px;
            padding: 15px;
            background: var(--light-bg);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: #e8f4ff;
            transform: translateX(5px);
        }

        .info-item i {
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 2px;
            flex-shrink: 0;
        }

        .info-content {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .info-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* Owner Card */
        .owner-info h5 {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 20px;
            text-align: center;
        }

        /* Medical Card */
        .medical-sections {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .medical-section {
            background: var(--light-bg);
            border-radius: 15px;
            padding: 0;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.1), rgba(0, 150, 199, 0.1));
            padding: 18px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 2px solid rgba(0, 119, 182, 0.1);
        }

        .section-header i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .section-header h6 {
            margin: 0;
            font-weight: 700;
            color: var(--primary-dark);
            font-size: 1rem;
        }

        .section-content {
            padding: 25px;
        }

        .section-content p {
            margin: 0;
            line-height: 1.6;
            color: var(--text-dark);
        }

        .diagnosa-box {
            background: white;
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.1);
        }

        .diagnosa-box p {
            font-weight: 600;
            color: var(--primary-dark);
        }

        /* Treatment Card */
        .treatments-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .treatment-item {
            background: white;
            border: 2px solid #e8e8e8;
            border-radius: 15px;
            padding: 25px;
            transition: all 0.3s ease;
        }

        .treatment-item:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.15);
        }

        .treatment-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 15px;
        }

        .treatment-code {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .code-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            box-shadow: 0 3px 8px rgba(0, 119, 182, 0.3);
        }

        .treatment-name {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.1rem;
        }

        .treatment-category {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
            flex-wrap: wrap;
        }

        .category-badge,
        .type-badge {
            background: var(--light-bg);
            color: var(--primary-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid rgba(0, 119, 182, 0.2);
        }

        .category-badge i,
        .type-badge i {
            font-size: 0.7rem;
        }

        .treatment-detail p {
            margin: 0;
            color: var(--text-gray);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* Empty Treatments */
        .empty-treatments {
            text-align: center;
            padding: 50px 30px;
        }

        .empty-icon {
            font-size: 4rem;
            color: rgba(0, 119, 182, 0.2);
            margin-bottom: 20px;
        }

        .empty-treatments h6 {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .empty-treatments p {
            color: var(--text-gray);
            margin-bottom: 25px;
        }

        /* Action Buttons Card */
        .action-buttons-card .card-body {
            padding: 25px;
        }

        .action-buttons-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .btn-action {
            padding: 15px 25px;
            border-radius: 12px;
            border: none;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            justify-content: center;
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.3);
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 165, 0, 0.4);
        }

        .btn-back {
            background: var(--light-bg);
            color: var(--text-dark);
            border: 2px solid #e8e8e8;
        }

        .btn-back:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
                gap: 15px;
            }

            .card-header-badge {
                margin-left: 0;
            }

            .card-header-left {
                flex-direction: column;
            }

            .treatment-header {
                flex-direction: column;
                gap: 15px;
            }

            .info-item {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }

            .patient-avatar {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .action-buttons-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection