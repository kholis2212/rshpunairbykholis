@extends('layouts.lte.main')

@section('title', 'Daftar Rekam Medis - RSHP UNAIR')

@section('page-icon', 'file-medical-fill')
@section('page-title', 'Daftar Rekam Medis Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard-dokter') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Rekam Medis</li>
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
            <h6>Tentang Daftar Rekam Medis</h6>
            <p>Berikut adalah daftar rekam medis pasien yang telah Anda tangani. Klik tombol detail untuk melihat dan mengelola detail rekam medis</p>
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
                    <h5>Daftar Rekam Medis Pasien</h5>
                    <p>Total: <span class="badge badge-count">{{ $rekamMedis->count() }}</span> rekam medis terdaftar</p>
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
                            <input type="text" id="searchInput" placeholder="Cari nama hewan, pemilik, atau diagnosa...">
                        </div>
                    </div>
                    
                    <div class="controls-right">
                        <div class="filter-group">
                            <div class="custom-select">
                                <select id="filterJenis">
                                    <option value="">Semua Jenis</option>
                                    <option value="Anjing">Anjing</option>
                                    <option value="Kucing">Kucing</option>
                                    <option value="Burung">Burung</option>
                                    <option value="Kelinci">Kelinci</option>
                                </select>
                                <div class="select-arrow">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table View -->
                <div class="table-responsive" id="tableView">
                    <table class="table data-table" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 80px;">
                                    <div class="th-content">
                                        <i class="bi bi-hash"></i>
                                        <span>No</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-paw-fill"></i>
                                        <span>Nama Hewan</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-tags-fill"></i>
                                        <span>Jenis/Ras</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-person-fill"></i>
                                        <span>Pemilik</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-calendar-event-fill"></i>
                                        <span>Tanggal</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-clipboard2-pulse-fill"></i>
                                        <span>Diagnosa</span>
                                    </div>
                                </th>
                                <th style="width: 150px;">
                                    <div class="th-content">
                                        <i class="bi bi-gear-fill"></i>
                                        <span>Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($rekamMedis as $index => $rekam)
                            <tr data-jenis="{{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan }}">
                                <td>
                                    <span class="badge-number">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="table-main-info">
                                        <div class="pet-avatar">
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
                                        <div class="pet-info">
                                            <strong>{{ $rekam->pet->nama }}</strong>
                                            <small>{{ $rekam->pet->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="breed-info">
                                        <span class="breed-type">{{ $rekam->pet->rasHewan->jenisHewan->nama_jenis_hewan }}</span>
                                        <span class="breed-name">{{ $rekam->pet->rasHewan->nama_ras }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="owner-info">
                                        <strong>{{ $rekam->pet->pemilik->user->nama }}</strong>
                                        <small>{{ $rekam->pet->pemilik->no_wa }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <strong>{{ $rekam->created_at->format('d M Y') }}</strong>
                                        <small>{{ $rekam->created_at->format('H:i') }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($rekam->diagnosa)
                                        <div class="diagnosa-info">
                                            <span class="diagnosa-text">{{ Str::limit($rekam->diagnosa, 80) }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('dokter.rekam-medis.show', $rekam->idrekam_medis) }}" 
                                           class="btn-action btn-view" 
                                           data-bs-toggle="tooltip" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                            <span class="btn-text">Detail</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    <p>Anda belum menangani rekam medis pasien</p>
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
            min-width: 120px;
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

        /* Table Styles */
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

        .th-content {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .th-content i {
            font-size: 1.1rem;
            color: var(--primary);
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
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
        }

        /* Pet Info Styles */
        .table-main-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .pet-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .pet-info {
            display: flex;
            flex-direction: column;
        }

        .pet-info strong {
            font-weight: 700;
            color: var(--text-dark);
            font-size: 0.95rem;
        }

        .pet-info small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .breed-info {
            display: flex;
            flex-direction: column;
        }

        .breed-type {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .breed-name {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .owner-info {
            display: flex;
            flex-direction: column;
        }

        .owner-info strong {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .owner-info small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .date-info {
            display: flex;
            flex-direction: column;
        }

        .date-info strong {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9rem;
        }

        .date-info small {
            font-size: 0.8rem;
            color: var(--text-gray);
        }

        .diagnosa-info {
            max-width: 250px;
        }

        .diagnosa-text {
            font-size: 0.85rem;
            color: var(--text-gray);
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-action {
            padding: 8px 12px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .btn-action::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-action:hover::before {
            left: 100%;
        }

        .btn-view {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .btn-view:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 119, 182, 0.4);
        }

        .btn-text {
            font-size: 0.8rem;
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

        /* Responsive */
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
            }

            .search-box input {
                width: 100%;
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
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn-action {
                justify-content: center;
            }

            .pet-avatar {
                width: 35px;
                height: 35px;
                font-size: 1.2rem;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        let currentPage = 1;
        let entriesPerPage = 10;
        let allRows = [];
        let filteredRows = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Loaded - Initializing table');
            
            allRows = Array.from(document.querySelectorAll('#tableBody tr'));
            filteredRows = [...allRows];
            
            console.log('Total rows found:', allRows.length);
            
            // Initialize event listeners
            document.getElementById('searchInput').addEventListener('input', searchTable);
            document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);
            document.getElementById('filterJenis').addEventListener('change', filterTable);
            document.getElementById('prevBtn').addEventListener('click', previousPage);
            document.getElementById('nextBtn').addEventListener('click', nextPage);
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            updatePagination();
        });

        // Search Function
        function searchTable() {
            console.log('🔍 Search function triggered');
            
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            
            console.log('Search term:', filter);
            console.log('Total rows to search:', allRows.length);

            filteredRows = allRows.filter(row => {
                const rowText = row.textContent.toLowerCase();
                return rowText.includes(filter);
            });

            console.log('Filtered rows count:', filteredRows.length);
            
            currentPage = 1;
            updatePagination();
        }

        // Filter by jenis hewan
        function filterTable() {
            const filterValue = document.getElementById('filterJenis').value.toLowerCase();
            
            if (filterValue === '') {
                filteredRows = [...allRows];
            } else {
                filteredRows = allRows.filter(row => {
                    const jenis = row.getAttribute('data-jenis').toLowerCase();
                    return jenis.includes(filterValue);
                });
            }
            
            currentPage = 1;
            updatePagination();
        }

        // Change entries per page
        function changeEntriesPerPage() {
            console.log('Entries per page changed');
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            updatePagination();
        }

        // Update pagination
        function updatePagination() {
            console.log('Updating pagination');
            
            const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;

            console.log('Current page:', currentPage, 'Total pages:', totalPages);
            console.log('Showing rows:', start, 'to', end);

            // Hide all rows
            allRows.forEach(row => row.style.display = 'none');

            // Show current page rows
            filteredRows.slice(start, end).forEach(row => {
                row.style.display = '';
            });

            // Update showing entries text
            const showingStart = filteredRows.length > 0 ? start + 1 : 0;
            const showingEnd = Math.min(end, filteredRows.length);
            const totalEntries = filteredRows.length;
            
            document.getElementById('showingText').textContent = 
                `Menampilkan ${showingStart} hingga ${showingEnd} dari ${totalEntries} data`;

            // Update pagination buttons
            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;

            // Generate page numbers
            generatePageNumbers(totalPages);
            
            console.log('Pagination updated successfully');
        }

        // Generate page numbers
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

        // Create page button
        function createPageButton(pageNum) {
            const btn = document.createElement('button');
            btn.className = 'page-number' + (pageNum === currentPage ? ' active' : '');
            btn.textContent = pageNum;
            btn.addEventListener('click', () => goToPage(pageNum));
            return btn;
        }

        // Create ellipsis
        function createEllipsis() {
            const span = document.createElement('span');
            span.textContent = '...';
            span.style.padding = '0 10px';
            span.style.color = 'var(--text-gray)';
            span.style.fontWeight = '600';
            return span;
        }

        // Go to specific page
        function goToPage(page) {
            console.log('Going to page:', page);
            currentPage = page;
            updatePagination();
        }

        // Previous page
        function previousPage() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
            }
        }

        // Next page
        function nextPage() {
            const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
            }
        }
    </script>
@endsection