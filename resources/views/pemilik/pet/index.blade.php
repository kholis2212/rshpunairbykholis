@extends('layouts.lte.main')

@section('title', 'Data Hewan Saya - RSHP UNAIR')

@section('page-icon', 'paw-fill')
@section('page-title', 'Data Hewan Peliharaan Saya')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('pemilik.dashboard-pemilik') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Hewan Saya</li>
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
            <h6>Tentang Data Hewan Peliharaan</h6>
            <p>Kelola informasi hewan peliharaan Anda. Lihat detail, riwayat kesehatan, dan informasi penting lainnya untuk setiap hewan yang terdaftar</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon">
                    <i class="bi bi-heart-pulse"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pets->count() }}</h3>
                    <p>Total Hewan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                    <i class="bi bi-file-medical"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pets->sum(function($pet) { return $pet->rekamMedis->count(); }) }}</h3>
                    <p>Total Rekam Medis</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pets->sum(function($pet) { return $pet->temuDokter->count(); }) }}</h3>
                    <p>Total Kunjungan</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card-small">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ffa500, #ff8c00);">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ $pets->filter(function($pet) { return $pet->temuDokter->where('status', 'P')->count() > 0; })->count() }}</h3>
                    <p>Sedang Diperiksa</p>
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
                    <h5>Daftar Hewan Peliharaan Saya</h5>
                    <p>Total: <span class="badge badge-count">{{ $pets->count() }}</span> hewan terdaftar</p>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($pets->count() > 0)
                <!-- Table Controls -->
                <div class="table-controls">
                    <div class="controls-left">
                        <!-- Show Entries -->
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
                            <input type="text" id="searchInput" placeholder="Cari nama hewan, ras, atau jenis...">
                        </div>
                    </div>
                    
                    <div class="controls-right">
                        <div class="filter-group">
                            <select id="filterJenis" class="form-control">
                                <option value="">Semua Jenis</option>
                                @foreach($pets->pluck('rasHewan.jenisHewan.nama_jenis_hewan')->unique() as $jenis)
                                    <option value="{{ $jenis }}">{{ $jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="filter-group">
                            <select id="filterStatus" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="active">Sedang Diperiksa</option>
                                <option value="inactive">Tidak Diperiksa</option>
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

                <!-- Grid View -->
                <div class="pets-grid" id="gridView">
                    @foreach($pets as $pet)
                    <div class="pet-card" data-name="{{ $pet->nama }}" data-ras="{{ $pet->rasHewan->nama_ras }}" data-jenis="{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}" data-status="{{ $pet->temuDokter->where('status', 'P')->count() > 0 ? 'active' : 'inactive' }}">
                        <div class="pet-card-header">
                            <div class="pet-avatar">
                                @if($pet->jenis_kelamin == 'J')
                                    <i class="bi bi-gender-male"></i>
                                @elseif($pet->jenis_kelamin == 'B')
                                    <i class="bi bi-gender-female"></i>
                                @else
                                    <i class="bi bi-gender-ambiguous"></i>
                                @endif
                            </div>
                            <div class="pet-status">
                                <span class="status-indicator {{ $pet->temuDokter->where('status', 'P')->count() > 0 ? 'active' : 'inactive' }}"></span>
                            </div>
                        </div>
                        
                        <div class="pet-card-body">
                            <h4 class="pet-name">{{ $pet->nama }}</h4>
                            <p class="pet-breed">{{ $pet->rasHewan->nama_ras }}</p>
                            <p class="pet-type">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}</p>
                            
                            <div class="pet-details">
                                <div class="detail-item">
                                    <i class="bi bi-gender-ambiguous"></i>
                                    <span>
                                        @if($pet->jenis_kelamin == 'J') Jantan
                                        @elseif($pet->jenis_kelamin == 'B') Betina
                                        @else Tidak Diketahui
                                        @endif
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-calendar"></i>
                                    <span>
                                        @if($pet->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun
                                        @else
                                            Usia tidak diketahui
                                        @endif
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-palette"></i>
                                    <span>{{ $pet->warna_tanda ?? 'Tidak ada' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="pet-card-footer">
                            <div class="pet-stats">
                                <div class="stat">
                                    <i class="bi bi-file-medical"></i>
                                    <span>{{ $pet->rekamMedis->count() }}</span>
                                </div>
                                <div class="stat">
                                    <i class="bi bi-calendar-check"></i>
                                    <span>{{ $pet->temuDokter->count() }}</span>
                                </div>
                            </div>
                            
                            <div class="pet-actions">
                                <a href="{{ route('pemilik.rekam-medis.index', $pet->idpet) }}" class="btn-action btn-medical" title="Rekam Medis">
                                    <i class="bi bi-file-medical"></i>
                                </a>
                                <a href="{{ route('pemilik.rekam-medis.show', $pet->idpet) }}" class="btn-action btn-info" title="Detail Rekam Medis" onclick="showPetDetail({{ $pet->idpet }})">
                                    <i class="bi bi-info-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Table View -->
                <div class="table-view" id="tableView" style="display: none;">
                    <div class="table-responsive">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">No</th>
                                    <th>Nama Hewan</th>
                                    <th>Jenis</th>
                                    <th>Ras</th>
                                    <th style="width: 100px;">Jenis Kelamin</th>
                                    <th style="width: 120px;">Usia</th>
                                    <th style="width: 100px;">Rekam Medis</th>
                                    <th style="width: 100px;">Kunjungan</th>
                                    <th style="width: 100px;">Status</th>
                                    <th style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach($pets as $index => $pet)
                                <tr data-name="{{ $pet->nama }}" data-ras="{{ $pet->rasHewan->nama_ras }}" data-jenis="{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}" data-status="{{ $pet->temuDokter->where('status', 'P')->count() > 0 ? 'active' : 'inactive' }}">
                                    <td>
                                        <span class="badge-number">{{ $index + 1 }}</span>
                                    </td>
                                    <td>
                                        <div class="table-main-info">
                                            <div class="info-avatar">
                                                @if($pet->jenis_kelamin == 'J')
                                                    <i class="bi bi-gender-male"></i>
                                                @elseif($pet->jenis_kelamin == 'B')
                                                    <i class="bi bi-gender-female"></i>
                                                @else
                                                    <i class="bi bi-gender-ambiguous"></i>
                                                @endif
                                            </div>
                                            <div class="info-text">
                                                <strong>{{ $pet->nama }}</strong>
                                                <small>{{ $pet->warna_tanda ?? 'Tidak ada warna/tanda' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan }}</strong>
                                    </td>
                                    <td>
                                        <span class="breed-badge">{{ $pet->rasHewan->nama_ras }}</span>
                                    </td>
                                    <td>
                                        <div class="gender-cell">
                                            @if($pet->jenis_kelamin == 'J')
                                                <i class="bi bi-gender-male"></i>
                                                <span>Jantan</span>
                                            @elseif($pet->jenis_kelamin == 'B')
                                                <i class="bi bi-gender-female"></i>
                                                <span>Betina</span>
                                            @else
                                                <i class="bi bi-gender-ambiguous"></i>
                                                <span>Tidak Diketahui</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="age-cell">
                                            <strong>
                                                @if($pet->tanggal_lahir)
                                                    {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun
                                                @else
                                                    Tidak diketahui
                                                @endif
                                            </strong>
                                            @if($pet->tanggal_lahir)
                                            <small>Lahir: {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="record-badge">
                                            <i class="bi bi-file-medical"></i>
                                            {{ $pet->rekamMedis->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="visit-badge">
                                            <i class="bi bi-calendar-check"></i>
                                            {{ $pet->temuDokter->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $pet->temuDokter->where('status', 'P')->count() > 0 ? 'active' : 'inactive' }}">
                                            <i class="bi bi-circle-fill"></i>
                                            {{ $pet->temuDokter->where('status', 'P')->count() > 0 ? 'Diperiksa' : 'Tidak Diperiksa' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('pemilik.rekam-medis.index', $pet->idpet) }}" class="btn-action btn-medical" title="Rekam Medis">
                                                <i class="bi bi-file-medical"></i>
                                            </a>
                                            <a href="{{ route('pemilik.rekam-medis.show', $pet->idpet) }}" class="btn-action btn-info" title="Detail">
                                                <i class="bi bi-info-circle"></i>
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
                        <span id="showingText">Menampilkan 1 hingga {{ min(10, $pets->count()) }} dari {{ $pets->count() }} data</span>
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

                <!-- Empty Search State -->
                <div class="empty-search-state" id="emptySearchState" style="display: none;">
                    <div class="empty-state-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h4>Data Tidak Ditemukan</h4>
                    <p>Tidak ada hewan yang sesuai dengan pencarian Anda</p>
                    <button class="btn-empty" onclick="clearSearch()">
                        <i class="bi bi-arrow-clockwise"></i>
                        <span>Tampilkan Semua</span>
                    </button>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-inbox"></i>
                    </div>
                    <h4>Belum Ada Data Hewan</h4>
                    <p>Silakan hubungi resepsionis untuk mendaftarkan hewan peliharaan Anda</p>
                    <div class="empty-state-actions">
                        <a href="{{ route('pemilik.dashboard-pemilik') }}" class="btn-empty">
                            <i class="bi bi-arrow-left"></i>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Pet Detail Modal -->
    <div class="modal fade" id="petDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="modal-title-section">
                        <div class="modal-icon">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div>
                            <h4 class="modal-title mb-1">Detail Hewan Peliharaan</h4>
                            <p class="modal-subtitle" id="modalSubtitle"></p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="petDetailContent">
                    <!-- Content will be loaded via AJAX -->
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i>
                        <span>Tutup</span>
                    </button>
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

        /* Stat Cards Small */
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
        }

        .stat-card-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 119, 182, 0.2);
            border-color: #0077b6;
        }

        .stat-card-small .stat-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #06d6a0, #05b589);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(6, 214, 160, 0.3);
        }

        .stat-card-small .stat-content h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #023e8a;
            margin: 0;
            line-height: 1;
        }

        .stat-card-small .stat-content p {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 600;
            margin: 5px 0 0 0;
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

        /* View Toggle Filter - Dipindahkan ke table controls */
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

        /* Pets Grid */
        .pets-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
            padding: 30px;
        }

        /* Pet Card */
        .pet-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 119, 182, 0.12);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            overflow: hidden;
            position: relative;
        }

        .pet-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 50px rgba(0, 119, 182, 0.2);
            border-color: var(--primary);
        }

        .pet-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px 20px 0 20px;
        }

        .pet-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        .pet-status {
            display: flex;
            align-items: center;
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .status-indicator.active {
            background: var(--success);
            animation: pulse 2s infinite;
        }

        .status-indicator.inactive {
            background: var(--text-gray);
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .pet-card-body {
            padding: 20px;
        }

        .pet-name {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin: 0 0 5px 0;
            line-height: 1.2;
        }

        .pet-breed {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin: 0 0 3px 0;
        }

        .pet-type {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0 0 15px 0;
            font-weight: 500;
        }

        .pet-details {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .detail-item i {
            color: var(--primary);
            font-size: 1rem;
            width: 16px;
            text-align: center;
        }

        .pet-card-footer {
            padding: 20px;
            background: var(--light-bg);
            border-top: 2px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pet-stats {
            display: flex;
            gap: 15px;
        }

        .pet-stats .stat {
            display: flex;
            align-items: center;
            gap: 5px;
            background: white;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            box-shadow: 0 2px 8px rgba(0, 119, 182, 0.1);
        }

        .pet-stats .stat i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .pet-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-medical {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
        }

        .btn-info {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .btn-action:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
        }

        /* Table View */
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
            background: linear-gradient(135deg, var(--primary), var(--secondary));
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

        .breed-badge {
            background: var(--light-bg);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--primary);
            display: inline-block;
            border: 1px solid #e8e8e8;
        }

        .gender-cell {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .gender-cell i {
            font-size: 1.1rem;
        }

        .age-cell {
            display: flex;
            flex-direction: column;
        }

        .age-cell strong {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .age-cell small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .record-badge, .visit-badge {
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

        .status-badge {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .status-badge.active {
            background: rgba(6, 214, 160, 0.1);
            color: #05b589;
            border: 1px solid rgba(6, 214, 160, 0.3);
        }

        .status-badge.inactive {
            background: rgba(74, 85, 104, 0.1);
            color: var(--text-gray);
            border: 1px solid rgba(74, 85, 104, 0.3);
        }

        .table-view .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
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

        /* Empty States */
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
            background: linear-gradient(135deg, var(--success), #05b589);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(6, 214, 160, 0.3);
            text-decoration: none;
        }

        .btn-empty:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
            color: white;
        }

        .empty-search-state {
            text-align: center;
            padding: 60px 30px;
            display: none;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 30px 30px 0;
        }

        .modal-title-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .modal-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .modal-title {
            font-weight: 700;
            color: var(--primary-dark);
            margin: 0;
        }

        .modal-subtitle {
            color: var(--text-gray);
            font-size: 0.9rem;
            margin: 0;
        }

        .modal-body {
            padding: 25px 30px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .modal-footer {
            padding: 0 30px 30px;
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-gray);
            border: 2px solid #e8e8e8;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        /* Loading Animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 119, 182, 0.3);
            border-radius: 50%;
            border-top-color: var(--primary);
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .pets-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: stretch;
            }

            .card-header-left {
                justify-content: center;
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

            .filter-group .form-control {
                width: 100%;
            }

            .pets-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }

            .pet-card {
                max-width: 100%;
            }

            .pet-card-footer {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .pet-stats {
                justify-content: center;
            }

            .pet-actions {
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
                flex-direction: column;
                text-align: center;
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

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Loaded - Initializing pets view');
            
            initializeGridView();
            
            document.getElementById('searchInput').addEventListener('input', filterItems);
            document.getElementById('filterJenis').addEventListener('change', filterItems);
            document.getElementById('filterStatus').addEventListener('change', filterItems);
            document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);
            document.getElementById('prevBtn').addEventListener('click', previousPage);
            document.getElementById('nextBtn').addEventListener('click', nextPage);
            
            updatePagination();
        });

        // Switch between grid and table view
        function switchView(view) {
            currentView = view;
            
            document.querySelectorAll('.toggle-btn-filter').forEach(btn => {
                btn.classList.toggle('active', btn.dataset.view === view);
            });
            
            document.getElementById('gridView').style.display = view === 'timeline' ? 'grid' : 'none';
            document.getElementById('tableView').style.display = view === 'table' ? 'block' : 'none';
            
            if (view === 'timeline') {
                initializeGridView();
            } else {
                initializeTableView();
            }
            
            filterItems();
        }

        function initializeGridView() {
            allItems = Array.from(document.querySelectorAll('#gridView .pet-card'));
            filteredItems = [...allItems];
            console.log('Grid items initialized:', allItems.length);
        }

        function initializeTableView() {
            allItems = Array.from(document.querySelectorAll('#tableBody tr'));
            filteredItems = [...allItems];
            console.log('Table rows initialized:', allItems.length);
        }

        // Filter items based on search and filters
        function filterItems() {
            const searchFilter = document.getElementById('searchInput').value.toLowerCase();
            const jenisFilter = document.getElementById('filterJenis').value;
            const statusFilter = document.getElementById('filterStatus').value;
            
            console.log('Filtering - Search:', searchFilter, 'Jenis:', jenisFilter, 'Status:', statusFilter);
            
            filteredItems = allItems.filter(item => {
                const name = item.dataset.name.toLowerCase();
                const ras = item.dataset.ras.toLowerCase();
                const jenis = item.dataset.jenis.toLowerCase();
                const status = item.dataset.status;
                
                const nameMatch = name.includes(searchFilter);
                const rasMatch = ras.includes(searchFilter);
                const jenisMatch = jenis.includes(searchFilter);
                
                const searchMatch = nameMatch || rasMatch || jenisMatch;
                const jenisFilterMatch = !jenisFilter || jenis === jenisFilter.toLowerCase();
                const statusFilterMatch = !statusFilter || status === statusFilter;
                
                return searchMatch && jenisFilterMatch && statusFilterMatch;
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
                item.style.display = currentView === 'timeline' ? 'block' : '';
            });

            const showingStart = filteredItems.length > 0 ? start + 1 : 0;
            const showingEnd = Math.min(end, filteredItems.length);
            const totalEntries = filteredItems.length;
            
            document.getElementById('showingText').textContent = 
                `Menampilkan ${showingStart} hingga ${showingEnd} dari ${totalEntries} data`;

            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;

            generatePageNumbers(totalPages);
            
            // Show/hide empty state
            const emptyState = document.getElementById('emptySearchState');
            const gridView = document.getElementById('gridView');
            const tableView = document.getElementById('tableView');
            
            if (filteredItems.length === 0 && (searchFilter || jenisFilter || statusFilter)) {
                emptyState.style.display = 'block';
                gridView.style.display = 'none';
                tableView.style.display = 'none';
            } else {
                emptyState.style.display = 'none';
                if (currentView === 'timeline') {
                    gridView.style.display = 'grid';
                } else {
                    tableView.style.display = 'block';
                }
            }
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

        // Clear search and filters
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('filterJenis').value = '';
            document.getElementById('filterStatus').value = '';
            filterItems();
        }

        // Show pet detail modal
        function showPetDetail(petId) {
            console.log('Loading pet detail for ID:', petId);
            
            const modal = new bootstrap.Modal(document.getElementById('petDetailModal'));
            const content = document.getElementById('petDetailContent');
            const subtitle = document.getElementById('modalSubtitle');
            
            // Show loading
            content.innerHTML = `
                <div class="text-center py-5">
                    <div class="loading-spinner mb-3"></div>
                    <p>Memuat data hewan...</p>
                </div>
            `;
            
            // Fetch pet data
            fetch(`/pemilik/pet/${petId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(html => {
                    content.innerHTML = html;
                    subtitle.textContent = 'Detail lengkap informasi hewan peliharaan';
                    modal.show();
                })
                .catch(error => {
                    console.error('Error loading pet detail:', error);
                    content.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Error!</strong> Gagal memuat data hewan. Silakan coba lagi.
                        </div>
                    `;
                    modal.show();
                });
        }

        // Auto refresh every 5 minutes
        setInterval(() => {
            window.location.reload();
        }, 300000);
    </script>
@endsection