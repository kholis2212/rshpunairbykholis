@extends('layouts.lte.main')

@section('title', 'Rekam Medis Hewan Saya - RSHP UNAIR')

@section('page-icon', 'file-medical')
@section('page-title', 'Rekam Medis Hewan Peliharaan Saya')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard-pemilik') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rekam Medis</li>
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

    <!-- Info Banner -->
    <div class="info-banner mb-4">
        <div class="info-banner-icon">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div class="info-banner-content">
            <h6>Tentang Rekam Medis</h6>
            <p>Kelola dan pantau riwayat kesehatan hewan peliharaan Anda. Lihat detail pemeriksaan, diagnosa, dan tindakan medis yang telah dilakukan oleh dokter</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon">
                    <i class="bi bi-file-medical"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $rekamMedis->count() }}</h3>
                    <p>Total Rekam Medis</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $rekamMedis->unique('idpet')->count() }}</h3>
                    <p>Hewan yang Diperiksa</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $rekamMedis->unique('dokter_pemeriksa')->count() }}</h3>
                    <p>Dokter Berbeda</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffa500, #ff8c00);">
                    <i class="bi bi-calendar-week"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $rekamMedis->where('created_at', '>=', now()->subDays(30))->count() }}</h3>
                    <p>30 Hari Terakhir</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card main-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="header-icon">
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="header-text">
                    <h5>Riwayat Rekam Medis</h5>
                    <p>Total: <span class="badge badge-count">{{ $rekamMedis->count() }}</span> rekam medis ditemukan</p>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($rekamMedis->count() > 0)
                <!-- Table Controls -->
                <div class="table-controls">
                    <div class="controls-left">
                        <div class="show-entries">
                            <label>
                                <span>Tampilkan</span>
                                <div class="custom-select">
                                    <select id="entriesPerPage">
                                        <option value="5">5</option>
                                        <option value="10" selected>10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                    <div class="select-arrow">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                <span>data</span>
                            </label>
                        </div>
                        
                        <!-- Search Box -->
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text" id="searchInput" placeholder="Cari nama hewan, diagnosa, atau dokter...">
                        </div>
                    </div>
                    
                    <div class="controls-right">
                        <div class="filter-group">
                            <select id="filterPet" class="form-control">
                                <option value="">Semua Hewan</option>
                                @foreach($rekamMedis->pluck('pet')->unique() as $pet)
                                    @if($pet)
                                        <option value="{{ $pet->idpet }}">{{ $pet->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <select id="filterDate" class="form-control">
                                <option value="">Semua Waktu</option>
                                <option value="today">Hari Ini</option>
                                <option value="week">Minggu Ini</option>
                                <option value="month">Bulan Ini</option>
                                <option value="year">Tahun Ini</option>
                            </select>
                        </div>
                        
                        <!-- View Toggle - Dipindahkan ke sini -->
                        <div class="view-toggle-filter">
                            <button class="toggle-btn-filter active" data-view="timeline" onclick="switchView('timeline')">
                                <i class="bi bi-list-ul"></i>
                                <span>Timeline</span>
                            </button>
                            <button class="toggle-btn-filter" data-view="table" onclick="switchView('table')">
                                <i class="bi bi-table"></i>
                                <span>Table</span>
                            </button>
                        </div>
                        
                        <div class="header-actions">
                            <button class="btn-refresh" onclick="window.location.reload()" title="Refresh Data">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Timeline View -->
                <div class="timeline-view" id="timelineView">
                    <div class="timeline-container">
                        @foreach($rekamMedis as $index => $rekam)
                        @php
                            $searchText = strtolower(
                                ($rekam->pet ? $rekam->pet->nama : '') . ' ' . 
                                ($rekam->diagnosa ?? '') . ' ' . 
                                ($rekam->dokterPemeriksa && $rekam->dokterPemeriksa->user ? $rekam->dokterPemeriksa->user->nama : 'Dokter Tidak Diketahui')
                            );
                        @endphp
                        <div class="timeline-item" data-pet="{{ $rekam->pet ? $rekam->pet->idpet : '' }}" data-date="{{ $rekam->created_at }}" data-search="{{ $searchText }}">
                            <div class="timeline-marker">
                                <div class="marker-icon">
                                    <i class="bi bi-file-medical"></i>
                                </div>
                                <div class="timeline-line"></div>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <div class="timeline-title">
                                        <div class="pet-avatar">
                                            @if($rekam->pet && $rekam->pet->jenis_kelamin == 'J')
                                                <i class="bi bi-gender-male"></i>
                                            @elseif($rekam->pet && $rekam->pet->jenis_kelamin == 'B')
                                                <i class="bi bi-gender-female"></i>
                                            @else
                                                <i class="bi bi-gender-ambiguous"></i>
                                            @endif
                                        </div>
                                        <div class="title-text">
                                            <h4>{{ $rekam->pet ? $rekam->pet->nama : 'Hewan Tidak Diketahui' }}</h4>
                                            <p>
                                                @if($rekam->pet && $rekam->pet->rasHewan && $rekam->pet->rasHewan->jenisHewan)
                                                    {{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan }} • {{ $rekam->pet->rasHewan->nama_ras }}
                                                @else
                                                    Jenis Hewan Tidak Diketahui
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="timeline-date">
                                        <i class="bi bi-calendar"></i>
                                        {{ \Carbon\Carbon::parse($rekam->created_at)->format('d M Y') }}
                                        <span class="timeline-time">
                                            {{ \Carbon\Carbon::parse($rekam->created_at)->format('H:i') }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="timeline-body">
                                    @if($rekam->diagnosa)
                                    <div class="diagnosa-section">
                                        <h5>
                                            <i class="bi bi-clipboard-check"></i>
                                            Diagnosa
                                        </h5>
                                        <p class="diagnosa-text">
                                            {{ $rekam->diagnosa }}
                                        </p>
                                    </div>
                                    @endif
                                    
                                    <div class="info-grid">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                            <div class="info-content">
                                                <label>Dokter Pemeriksa</label>
                                                <span>{{ $rekam->dokterPemeriksa && $rekam->dokterPemeriksa->user ? $rekam->dokterPemeriksa->user->nama : 'Dokter Tidak Diketahui' }}</span>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="bi bi-list-check"></i>
                                            </div>
                                            <div class="info-content">
                                                <label>Total Tindakan</label>
                                                <span>{{ $rekam->detailRekamMedis ? $rekam->detailRekamMedis->count() : 0 }} Tindakan</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($rekam->anamnesa || $rekam->temuan_klinis)
                                    <div class="additional-info">
                                        @if($rekam->anamnesa)
                                        <div class="info-snippet">
                                            <h6>
                                                <i class="bi bi-chat-left-text"></i>
                                                Anamnesa
                                            </h6>
                                            <p>{{ Str::limit($rekam->anamnesa, 120) }}</p>
                                        </div>
                                        @endif
                                        
                                        @if($rekam->temuan_klinis)
                                        <div class="info-snippet">
                                            <h6>
                                                <i class="bi bi-search-heart"></i>
                                                Temuan Klinis
                                            </h6>
                                            <p>{{ Str::limit($rekam->temuan_klinis, 120) }}</p>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="timeline-footer">
                                    <div class="action-buttons">
                                        <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn-action btn-primary">
                                            <i class="bi bi-eye"></i>
                                            <span>Lihat Detail</span>
                                        </a>
                                       
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Table View -->
                <div class="table-view" id="tableView" style="display: none;">
                    <div class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Hewan</th>
                                    <th>Diagnosa</th>
                                    <th style="width: 150px;">Dokter</th>
                                    <th style="width: 120px;">Tanggal</th>
                                    <th style="width: 100px;">Tindakan</th>
                                    <th style="width: 80px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($rekamMedis as $index => $rekam)
                                @php
                                    $searchText = strtolower(
                                        ($rekam->pet ? $rekam->pet->nama : '') . ' ' . 
                                        ($rekam->diagnosa ?? '') . ' ' . 
                                        ($rekam->dokterPemeriksa && $rekam->dokterPemeriksa->user ? $rekam->dokterPemeriksa->user->nama : 'Dokter Tidak Diketahui')
                                    );
                                @endphp
                                <tr data-pet="{{ $rekam->pet ? $rekam->pet->idpet : '' }}" data-date="{{ $rekam->created_at }}" data-search="{{ $searchText }}">
                                    <td>
                                        <span class="badge-number">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="table-main-info">
                                            <div class="info-avatar">
                                                @if($rekam->pet && $rekam->pet->jenis_kelamin == 'J')
                                                    <i class="bi bi-gender-male"></i>
                                                @elseif($rekam->pet && $rekam->pet->jenis_kelamin == 'B')
                                                    <i class="bi bi-gender-female"></i>
                                                @else
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                @endif
                                            </div>
                                            <div class="info-text">
                                                <strong>{{ $rekam->pet ? $rekam->pet->nama : 'Hewan Tidak Diketahui' }}</strong>
                                                <small>
                                                    @if($rekam->pet && $rekam->pet->rasHewan && $rekam->pet->rasHewan->jenisHewan)
                                                        {{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan }}
                                                    @else
                                                        Jenis Hewan Tidak Diketahui
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="diagnosa-cell">
                                            <strong>{{ $rekam->diagnosa ? Str::limit($rekam->diagnosa, 60) : 'Tidak ada diagnosa' }}</strong>
                                            @if($rekam->anamnesa)
                                            <small>{{ Str::limit($rekam->anamnesa, 80) }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="doctor-cell">
                                            <div class="doctor-avatar">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                            <div class="doctor-info">
                                                <strong>{{ $rekam->dokterPemeriksa && $rekam->dokterPemeriksa->user ? $rekam->dokterPemeriksa->user->nama : 'Dokter Tidak Diketahui' }}</strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="date-cell">
                                            <strong>{{ \Carbon\Carbon::parse($rekam->created_at)->format('d M Y') }}</strong>
                                            <small>{{ \Carbon\Carbon::parse($rekam->created_at)->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="tindakan-badge">
                                            <i class="bi bi-list-check"></i>
                                            {{ $rekam->detailRekamMedis ? $rekam->detailRekamMedis->count() : 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('pemilik.rekam-medis.show', $rekam->idrekam_medis) }}" class="btn-action btn-view" title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="table-footer">
                    <div class="showing-entries">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        <span id="showingText">Menampilkan 1 hingga {{ min(10, $rekamMedis->count()) }} dari {{ $rekamMedis->count() }} data</span>
                    </div>
                    <div class="pagination-controls">
                        <button class="pagination-btn" id="prevBtn">
                            <i class="bi bi-chevron-left"></i>
                            <span>Sebelumnya</span>
                        </button>
                        <div class="pagination-numbers" id="paginationNumbers"></div>
                        <button class="pagination-btn" id="nextBtn">
                            <span>Selanjutnya</span>
                            <i class="bi bi-chevron-right"></i>
                        </button>
                    </div>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-file-medical"></i>
                    </div>
                    <h4>Belum Ada Rekam Medis</h4>
                    <p>Belum ada riwayat rekam medis untuk hewan peliharaan Anda. Rekam medis akan tersedia setelah hewan Anda diperiksa oleh dokter</p>
                    <div class="empty-state-actions">
                        <a href="{{ route('pemilik.pet.index') }}" class="btn-empty btn-primary">
                            <i class="bi bi-paw"></i>
                            <span>Lihat Data Hewan</span>
                        </a>
                        <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn-empty btn-secondary">
                            <i class="bi bi-arrow-left"></i>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    </div>
                </div>
            @endif
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

        .alert-text strong {
            font-size: 1rem;
            display: block;
            margin-bottom: 3px;
            color: var(--success);
        }

        .alert-text p {
            color: var(--text-gray);
            margin: 0;
            font-size: 0.9rem;
        }

        .alert .btn-close {
            padding: 20px;
        }

        /* Info Banner */
        .info-banner {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border: 2px solid rgba(0, 119, 182, 0.2);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            animation: slideDown 0.6s ease;
        }

        .info-banner-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .info-banner-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0 0 5px 0;
        }

        .info-banner-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.5;
        }

        /* Statistic Cards */
        .stat-card-small {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.12);
            display: flex;
            align-items: center;
            gap: 15px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            height: 100%;
        }

        .stat-card-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 119, 182, 0.2);
            border-color: #0077b6;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
            color: white;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .stat-content p {
            font-size: 0.85rem;
            color: var(--text-gray);
            margin: 0;
            font-weight: 600;
        }

        /* Main Card */
        .main-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
            animation: slideUp 0.7s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 25px 30px;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card-header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
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

        .header-text h5 {
            margin: 0 0 5px 0;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .header-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .badge-count {
            background: rgba(255, 255, 255, 0.3);
            padding: 3px 10px;
            border-radius: 12px;
            font-weight: 700;
            backdrop-filter: blur(10px);
        }

        /* View Toggle Filter - Style Baru */
        .view-toggle-filter {
            display: flex;
            gap: 5px;
            background: white;
            padding: 5px;
            border-radius: 10px;
            border: 2px solid #e8e8e8;
        }

        .toggle-btn-filter {
            background: transparent;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            color: var(--text-gray);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .toggle-btn-filter.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 3px 10px rgba(0, 119, 182, 0.2);
        }

        .toggle-btn-filter:hover:not(.active) {
            background: #f0f9ff;
            color: var(--primary);
        }

        .btn-refresh {
            background: white;
            border: 2px solid #e8e8e8;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-refresh:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: rotate(180deg);
        }

        /* Table Controls */
        .table-controls {
            padding: 20px 30px;
            background: var(--light-bg);
            border-bottom: 2px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .controls-left {
            display: flex;
            align-items: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .controls-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .show-entries label {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Custom Select Styling */
        .custom-select {
            position: relative;
            display: inline-block;
        }

        .custom-select select {
            padding: 8px 35px 8px 15px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: white;
            color: var(--primary-dark);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            appearance: none;
            min-width: 80px;
        }

        .custom-select select:hover {
            border-color: var(--primary);
        }

        .custom-select select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
        }

        .select-arrow {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--primary);
            font-size: 0.8rem;
        }

        /* Search Box */
        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
            font-size: 1rem;
        }

        .search-box input {
            padding: 10px 15px 10px 45px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: white;
            color: var(--text-dark);
            font-size: 0.9rem;
            width: 300px;
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: var(--text-gray);
            opacity: 0.7;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
        }

        /* Filter Group */
        .filter-group {
            display: flex;
            align-items: center;
        }

        .filter-group .form-control {
            padding: 10px 15px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: white;
            color: var(--text-dark);
            font-size: 0.9rem;
            min-width: 140px;
            transition: all 0.3s ease;
        }

        .filter-group .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
        }

        /* Improved Timeline View */
        .timeline-view {
            padding: 30px;
        }

        .timeline-container {
            position: relative;
            max-width: 100%;
        }

        .timeline-item {
            display: flex;
            margin-bottom: 25px;
            position: relative;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .timeline-marker {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 25px;
            position: relative;
        }

        .marker-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
            z-index: 2;
            position: relative;
        }

        .timeline-line {
            width: 3px;
            flex: 1;
            background: linear-gradient(to bottom, #0077b6, #0096c7);
            margin-top: 10px;
            border-radius: 2px;
        }

        .timeline-item:last-child .timeline-line {
            display: none;
        }

        .timeline-content {
            flex: 1;
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.1);
            border: 2px solid #f8fbff;
            transition: all 0.3s ease;
        }

        .timeline-content:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.15);
            border-color: #0077b6;
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8fbff;
        }

        .timeline-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .pet-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .title-text h4 {
            margin: 0 0 5px 0;
            font-size: 1.3rem;
            font-weight: 700;
            color: #023e8a;
        }

        .title-text p {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-gray);
        }

        .timeline-date {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.9rem;
        }

        .timeline-time {
            background: var(--light-bg);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            margin-left: 5px;
        }

        .timeline-body {
            margin-bottom: 20px;
        }

        .diagnosa-section {
            margin-bottom: 20px;
        }

        .diagnosa-section h5 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0 0 10px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .diagnosa-text {
            color: var(--text-dark);
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 0;
            padding: 15px;
            background: #f8fbff;
            border-radius: 8px;
            border-left: 4px solid #0077b6;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin: 20px 0;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
        }

        .info-icon {
            color: #0077b6;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        .info-content label {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 600;
            margin: 0;
            display: block;
        }

        .info-content span {
            font-size: 0.9rem;
            color: var(--text-dark);
            font-weight: 700;
            display: block;
        }

        .additional-info {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .info-snippet {
            flex: 1;
            min-width: 200px;
            padding: 12px;
            background: #fff8e6;
            border-radius: 8px;
            border-left: 3px solid #ffa500;
        }

        .info-snippet h6 {
            font-size: 0.85rem;
            font-weight: 700;
            color: #856404;
            margin: 0 0 5px 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-snippet p {
            font-size: 0.8rem;
            color: #856404;
            margin: 0;
            line-height: 1.4;
        }

        .timeline-footer {
            padding-top: 15px;
            border-top: 2px solid #f8fbff;
        }

        .timeline-footer .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-gray);
            border: 1px solid #e8e8e8;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            color: white;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            color: var(--text-dark);
        }

        /* Improved Table View */
        .table-view {
            padding: 0;
        }

        .data-table {
            margin: 0;
        }

        .data-table thead {
            background: var(--light-bg);
        }

        .data-table th {
            padding: 18px 20px;
            font-weight: 700;
            color: var(--primary-dark);
            border: none;
            border-bottom: 3px solid var(--primary);
        }

        .data-table td {
            padding: 18px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #e8e8e8;
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: #f0f9ff;
            transform: scale(1.005);
        }

        .badge-number {
            background: linear-gradient(135deg, #ffc300, #ffdb4d);
            color: var(--primary-dark);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
        }

        .table-main-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .info-text strong {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-dark);
            display: block;
        }

        .info-text small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .diagnosa-cell {
            display: flex;
            flex-direction: column;
        }

        .diagnosa-cell strong {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 3px;
        }

        .diagnosa-cell small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .doctor-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doctor-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .doctor-info strong {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .date-cell {
            display: flex;
            flex-direction: column;
        }

        .date-cell strong {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .date-cell small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .tindakan-badge {
            background: var(--light-bg);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border: 1px solid #e8e8e8;
        }

        .table-view .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .btn-view {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border: none;
            border-radius: 8px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        /* Table Footer */
        .table-footer {
            padding: 20px 30px;
            background: var(--light-bg);
            border-top: 2px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .showing-entries {
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .showing-entries span {
            color: var(--primary);
            font-weight: 700;
        }

        #showingText {
            color: var(--text-gray);
            font-weight: 600;
        }

        .pagination-controls {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .pagination-btn {
            padding: 10px 20px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: white;
            color: var(--text-gray);
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pagination-btn:hover:not(:disabled) {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .pagination-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pagination-btn i {
            font-size: 1rem;
        }

        .pagination-numbers {
            display: flex;
            gap: 5px;
        }

        .page-number {
            width: 40px;
            height: 40px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: white;
            color: var(--text-gray);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-number:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .page-number.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 30px;
        }

        .empty-state-icon {
            font-size: 5rem;
            color: rgba(0, 119, 182, 0.2);
            margin-bottom: 25px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .empty-state h4 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 25px;
        }

        .empty-state-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-empty {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-gray);
            border: 2px solid #e8e8e8;
        }

        .btn-empty:hover {
            transform: translateY(-3px);
        }

        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
            color: white;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            color: var(--text-dark);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: stretch;
            }

            .card-header-left {
                justify-content: center;
            }

            .card-header-right {
                width: 100%;
                justify-content: space-between;
            }

            .table-controls {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .controls-left {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .controls-right {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
                gap: 10px;
            }

            .search-box input {
                width: 100%;
            }

            .timeline-item {
                flex-direction: column;
            }

            .timeline-marker {
                margin-right: 0;
                margin-bottom: 15px;
                flex-direction: row;
                align-items: center;
            }

            .timeline-line {
                width: 100%;
                height: 3px;
                margin-top: 0;
                margin-left: 10px;
            }

            .timeline-header {
                flex-direction: column;
                gap: 10px;
            }

            .additional-info {
                flex-direction: column;
            }

            .info-snippet {
                min-width: 100%;
            }

            .timeline-footer .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }

            .empty-state-actions {
                flex-direction: column;
            }

            .btn-empty {
                width: 100%;
                justify-content: center;
            }

            .table-footer {
                flex-direction: column;
            }

            .pagination-controls {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }

            .pagination-btn span {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .stat-card-small {
                padding: 15px;
            }
            
            .stat-icon {
                width: 50px;
                height: 50px;
                font-size: 1.3rem;
            }
            
            .table-controls {
                padding: 15px 20px;
            }
            
            .data-table th,
            .data-table td {
                padding: 12px 15px;
            }
            
            .controls-right {
                flex-direction: column;
                align-items: stretch;
            }
            
            .view-toggle-filter {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        let currentView = 'timeline';
        let currentPage = 1;
        let entriesPerPage = 10;
        let allItems = [];
        let filteredItems = [];

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Loaded - Initializing rekam medis table');
            
            initializeTimelineView();
            initializeTableView();
            
            document.getElementById('searchInput').addEventListener('input', filterItems);
            document.getElementById('filterPet').addEventListener('change', filterItems);
            document.getElementById('filterDate').addEventListener('change', filterItems);
            document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);
            document.getElementById('prevBtn').addEventListener('click', previousPage);
            document.getElementById('nextBtn').addEventListener('click', nextPage);
            
            updatePagination();
        });

        function switchView(view) {
            currentView = view;
            
            document.querySelectorAll('.toggle-btn-filter').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.view === view);
            });
            
            document.getElementById('timelineView').style.display = view === 'timeline' ? 'block' : 'none';
            document.getElementById('tableView').style.display = view === 'table' ? 'block' : 'none';
            
            if (view === 'timeline') {
                initializeTimelineView();
            } else {
                initializeTableView();
            }
            
            filterItems();
        }

        function initializeTimelineView() {
            allItems = Array.from(document.querySelectorAll('#timelineView .timeline-item'));
            filteredItems = [...allItems];
            console.log('Timeline items initialized:', allItems.length);
        }

        function initializeTableView() {
            allItems = Array.from(document.querySelectorAll('#tableBody tr'));
            filteredItems = [...allItems];
            console.log('Table rows initialized:', allItems.length);
        }

        function filterItems() {
            const searchFilter = document.getElementById('searchInput').value.toLowerCase();
            const petFilter = document.getElementById('filterPet').value;
            const dateFilter = document.getElementById('filterDate').value;
            
            console.log('Filtering - Search:', searchFilter, 'Pet:', petFilter, 'Date:', dateFilter);
            
            filteredItems = allItems.filter(item => {
                const searchMatch = !searchFilter || item.dataset.search.includes(searchFilter);
                const petMatch = !petFilter || item.dataset.pet === petFilter;
                
                let dateMatch = true;
                if (dateFilter) {
                    const itemDate = new Date(item.dataset.date);
                    const today = new Date();
                    
                    switch(dateFilter) {
                        case 'today':
                            dateMatch = itemDate.toDateString() === today.toDateString();
                            break;
                        case 'week':
                            const startOfWeek = new Date(today);
                            startOfWeek.setDate(today.getDate() - today.getDay());
                            dateMatch = itemDate >= startOfWeek;
                            break;
                        case 'month':
                            dateMatch = itemDate.getMonth() === today.getMonth() && 
                                       itemDate.getFullYear() === today.getFullYear();
                            break;
                        case 'year':
                            dateMatch = itemDate.getFullYear() === today.getFullYear();
                            break;
                    }
                }
                
                return searchMatch && petMatch && dateMatch;
            });

            console.log('Filtered items count:', filteredItems.length);
            
            currentPage = 1;
            updatePagination();
        }

        function changeEntriesPerPage() {
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            updatePagination();
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredItems.length / entriesPerPage);
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;

            allItems.forEach(item => item.style.display = 'none');
            filteredItems.slice(start, end).forEach(item => {
                item.style.display = currentView === 'timeline' ? 'flex' : '';
            });

            const showingStart = filteredItems.length > 0 ? start + 1 : 0;
            const showingEnd = Math.min(end, filteredItems.length);
            const totalEntries = filteredItems.length;
            
            document.getElementById('showingText').textContent = 
                `Menampilkan ${showingStart} hingga ${showingEnd} dari ${totalEntries} data`;

            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;

            generatePageNumbers(totalPages);
        }

        function generatePageNumbers(totalPages) {
            const container = document.getElementById('paginationNumbers');
            container.innerHTML = '';

            if (totalPages <= 5) {
                for (let i = 1; i <= totalPages; i++) {
                    container.appendChild(createPageButton(i));
                }
            } else {
                if (currentPage <= 3) {
                    for (let i = 1; i <= 4; i++) {
                        container.appendChild(createPageButton(i));
                    }
                    container.appendChild(createEllipsis());
                    container.appendChild(createPageButton(totalPages));
                } else if (currentPage >= totalPages - 2) {
                    container.appendChild(createPageButton(1));
                    container.appendChild(createEllipsis());
                    for (let i = totalPages - 3; i <= totalPages; i++) {
                        container.appendChild(createPageButton(i));
                    }
                } else {
                    container.appendChild(createPageButton(1));
                    container.appendChild(createEllipsis());
                    for (let i = currentPage - 1; i <= currentPage + 1; i++) {
                        container.appendChild(createPageButton(i));
                    }
                    container.appendChild(createEllipsis());
                    container.appendChild(createPageButton(totalPages));
                }
            }
        }

        function createPageButton(pageNum) {
            const btn = document.createElement('button');
            btn.className = 'page-number' + (pageNum === currentPage ? ' active' : '');
            btn.textContent = pageNum;
            btn.addEventListener('click', () => goToPage(pageNum));
            return btn;
        }

        function createEllipsis() {
            const span = document.createElement('span');
            span.textContent = '...';
            span.style.padding = '0 10px';
            span.style.color = 'var(--text-gray)';
            span.style.fontWeight = '600';
            return span;
        }

        function goToPage(page) {
            currentPage = page;
            updatePagination();
        }

        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        }

        function nextPage() {
            const totalPages = Math.ceil(filteredItems.length / entriesPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
            }
        }

        // Auto refresh every 5 minutes
        setInterval(() => {
            window.location.reload();
        }, 300000);
    </script>
@endsection