{{-- views/resepsionis/temu-dokter/index.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Daftar Temu Dokter - RSHP UNAIR')

@section('page-icon', 'calendar-check-fill')
@section('page-title', 'Daftar Temu Dokter Hari Ini')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Temu Dokter</li>
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
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="alert-text">
                    <strong>Error!</strong>
                    <p>{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #0077b6, #0096c7);">
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="info-content">
                    <h6>Total Antrian</h6>
                    <p>{{ $statistik['total'] }} Pasien</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #06d6a0, #05b589);">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="info-content">
                    <h6>Dalam Antrian</h6>
                    <p>{{ $statistik['aktif'] }} Pasien</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #ffa500, #ff8c00);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="info-content">
                    <h6>Selesai</h6>
                    <p>{{ $statistik['selesai'] }} Pasien</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="info-card">
                <div class="info-icon" style="background: linear-gradient(135deg, #ef476f, #d62839);">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="info-content">
                    <h6>Dibatalkan</h6>
                    <p>{{ $statistik['cancel'] }} Pasien</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Banner -->
    <div class="info-banner mb-4">
        <div class="info-banner-icon">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div class="info-banner-content">
            <h6>Manajemen Antrian Temu Dokter</h6>
            <p>Kelola jadwal temu dokter untuk hari ini. Pastikan nomor antrian berjalan dengan lancar dan status diperbarui secara real-time</p>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card main-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="header-icon">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                <div class="header-text">
                    <h5>Daftar Temu Dokter Hari Ini</h5>
                    <p>Total: <span class="badge badge-count">{{ $temuDokter->count() }}</span> janji temu</p>
                </div>
            </div>
            <!-- Hapus card-header-right (tombol tambah dipindah ke table controls) -->
        </div>

        <div class="card-body p-0">
            @if($temuDokter->count() > 0)
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
                            <input type="text" id="searchInput" placeholder="Cari nama pemilik dan pet">
                        </div>

                        <!-- Filter Status -->
                        <div class="filter-status">
                            <div class="custom-select">
                                <select id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="A">Aktif</option>
                                    <option value="S">Selesai</option>
                                    <option value="C">Dibatalkan</option>
                                </select>
                                <div class="select-arrow">
                                    <i class="bi bi-funnel-fill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="controls-right">
                        <!-- Tombol Tambah Janji Temu dipindah ke sini -->
                        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn-add">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span class="btn-text">Tambah Janji Temu</span>
                        </a>
                        <!-- Hapus tombol refresh -->
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
                                <th style="width: 100px;">
                                    <div class="th-content">
                                        <i class="bi bi-123"></i>
                                        <span>Antrian</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-person-fill"></i>
                                        <span>Pemilik & Pet</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-heart-pulse-fill"></i>
                                        <span>Dokter</span>
                                    </div>
                                </th>
                                <th style="width: 150px;">
                                    <div class="th-content">
                                        <i class="bi bi-clock-fill"></i>
                                        <span>Waktu Daftar</span>
                                    </div>
                                </th>
                                <th style="width: 120px;">
                                    <div class="th-content">
                                        <i class="bi bi-circle-fill"></i>
                                        <span>Status</span>
                                    </div>
                                </th>
                                <th style="width: 200px;">
                                    <div class="th-content">
                                        <i class="bi bi-gear-fill"></i>
                                        <span>Aksi</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($temuDokter as $index => $item)
                            <tr data-status="{{ $item->status }}">
                                <td>
                                    <span class="badge-number">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="queue-number">
                                        <span class="queue-badge">#{{ $item->no_urut }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="table-main-info">
                                        <div class="info-primary">
                                            <strong>{{ $item->pet->nama ?? 'N/A' }}</strong>
                                            <span class="pet-type">
                                                {{ $item->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '' }} - 
                                                {{ $item->pet->rasHewan->nama_ras ?? '' }}
                                            </span>
                                        </div>
                                        <div class="info-secondary">
                                            <i class="bi bi-person"></i>
                                            <span>{{ $item->pet->pemilik->user->nama ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="doctor-info">
                                        <i class="bi bi-heart-pulse"></i>
                                        <span>{{ $item->userDokter->nama ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="time-info">
                                        <div class="time-main">
                                            {{ $item->waktu_daftar->format('H:i') }}
                                        </div>
                                        <div class="time-sub">
                                            {{ $item->waktu_daftar->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $item->warna_status }}">
                                        <i class="bi bi-circle-fill"></i>
                                        {{ $item->status_lengkap }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Quick Status Update -->
                                        <div class="status-actions">
                                            <button class="btn-status btn-status-active @if($item->status == 'A') active @endif" 
                                                    data-id="{{ $item->idreservasi_dokter }}" 
                                                    data-status="A"
                                                    title="Set Aktif">
                                                <i class="bi bi-clock"></i>
                                            </button>
                                            <button class="btn-status btn-status-completed @if($item->status == 'S') active @endif" 
                                                    data-id="{{ $item->idreservasi_dokter }}" 
                                                    data-status="S"
                                                    title="Set Selesai">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                            <button class="btn-status btn-status-cancelled @if($item->status == 'C') active @endif" 
                                                    data-id="{{ $item->idreservasi_dokter }}" 
                                                    data-status="C"
                                                    title="Set Batal">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>

                                        <!-- Main Actions -->
                                        <div class="main-actions">
                                            <a href="{{ route('resepsionis.temu-dokter.edit', $item->idreservasi_dokter) }}" 
                                               class="btn-action btn-edit" 
                                               data-bs-toggle="tooltip" 
                                               title="Edit Data">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button data-id="{{ $item->idreservasi_dokter }}" 
                                                    data-queue="{{ $item->no_urut }}"
                                                    class="btn-action btn-delete"
                                                    data-bs-toggle="tooltip" 
                                                    title="Hapus Data">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </div>
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
                        <span id="showingText">Menampilkan 1 hingga {{ min(10, $temuDokter->count()) }} dari {{ $temuDokter->count() }} data</span>
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
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <h4>Belum Ada Janji Temu</h4>
                    <p>Belum ada jadwal temu dokter untuk hari ini. Silakan tambahkan janji temu baru</p>
                    <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn-empty">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Tambah Janji Temu Pertama</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="modal-icon modal-icon-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4 class="modal-title mb-3">Konfirmasi Hapus</h4>
                    <p class="modal-text">Apakah Anda yakin ingin menghapus janji temu nomor antrian <strong id="deleteQueueNumber"></strong>?</p>
                    <div class="modal-warning">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Data yang dihapus tidak dapat dikembalikan!</span>
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i>
                            <span>Batal</span>
                        </button>
                        <button type="submit" class="btn btn-confirm-delete">
                            <i class="bi bi-trash-fill"></i>
                            <span>Ya, Hapus!</span>
                        </button>
                    </form>
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

        /* Statistik Cards */
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
            height: 100%;
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
            font-size: 1.5rem;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(0, 119, 182, 0.3);
            color: white;
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

        .card-header-right {
            display: flex;
            align-items: center;
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

        /* Filter Status */
        .filter-status .custom-select select {
            min-width: 140px;
        }

        /* Buttons */
        .btn-add {
            background: linear-gradient(135deg, var(--success), #05b589);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 214, 160, 0.3);
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-add:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 18px rgba(6, 214, 160, 0.4);
            color: white;
        }

        .btn-add:active {
            transform: translateY(0);
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

        /* Badge Styles */
        .badge-number {
            background: linear-gradient(135deg, #ffc300, #ffdb4d);
            color: var(--primary-dark);
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.9rem;
            display: inline-block;
        }

        .queue-number {
            text-align: center;
        }

        .queue-badge {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 800;
            font-size: 1.1rem;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 119, 182, 0.3);
        }

        /* Table Content Styles */
        .table-main-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .info-primary {
            display: flex;
            flex-direction: column;
        }

        .info-primary strong {
            color: var(--text-dark);
            font-size: 1rem;
            font-weight: 700;
        }

        .pet-type {
            color: var(--text-gray);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .info-secondary {
            display: flex;
            align-items: center;
            gap: 6px;
            color: var(--text-gray);
            font-size: 0.85rem;
        }

        .info-secondary i {
            color: var(--primary);
            font-size: 0.9rem;
        }

        .doctor-info {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-dark);
            font-weight: 600;
        }

        .doctor-info i {
            color: var(--danger);
            font-size: 1.1rem;
        }

        .time-info {
            text-align: center;
        }

        .time-main {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        .time-sub {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 500;
        }

        /* Status Badges */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-badge i {
            font-size: 0.6rem;
        }

        .status-success {
            background: linear-gradient(135deg, rgba(6, 214, 160, 0.15), rgba(5, 181, 137, 0.15));
            color: var(--success);
            border: 2px solid var(--success);
        }

        .status-primary {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.15), rgba(0, 150, 199, 0.15));
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .status-danger {
            background: linear-gradient(135deg, rgba(239, 71, 111, 0.15), rgba(214, 40, 57, 0.15));
            color: var(--danger);
            border: 2px solid var(--danger);
        }

        .status-secondary {
            background: linear-gradient(135deg, rgba(74, 85, 104, 0.15), rgba(113, 128, 150, 0.15));
            color: var(--text-gray);
            border: 2px solid var(--text-gray);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .status-actions {
            display: flex;
            gap: 5px;
            border-right: 2px solid #e8e8e8;
            padding-right: 10px;
        }

        .main-actions {
            display: flex;
            gap: 5px;
        }

        .btn-status {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            color: white;
        }

        .btn-status-active {
            background: var(--success);
        }

        .btn-status-completed {
            background: var(--primary);
        }

        .btn-status-cancelled {
            background: var(--danger);
        }

        .btn-status:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-status.active {
            transform: scale(1.15);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-action {
            width: 35px;
            height: 35px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 165, 0, 0.4);
        }

        .btn-delete {
            background: linear-gradient(135deg, var(--danger), #d62839);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(239, 71, 111, 0.4);
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

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 30px 30px 0;
            justify-content: center;
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto;
            animation: pulse 2s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .modal-icon-danger {
            background: linear-gradient(135deg, rgba(239, 71, 111, 0.15), rgba(214, 40, 57, 0.15));
            color: var(--danger);
        }

        .modal-body {
            padding: 25px 40px;
        }

        .modal-title {
            font-weight: 700;
            color: var(--primary-dark);
        }

        .modal-text {
            color: var(--text-gray);
            font-size: 1rem;
            margin-bottom: 15px;
        }

        .modal-warning {
            background: #fff5f5;
            border: 2px solid var(--danger);
            border-radius: 10px;
            padding: 12px 15px;
            color: var(--danger);
            font-size: 0.9rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .modal-footer {
            padding: 0 40px 30px;
        }

        .btn-cancel {
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

        .btn-cancel:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        .btn-confirm-delete {
            background: linear-gradient(135deg, var(--danger), #d62839);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(239, 71, 111, 0.3);
        }

        .btn-confirm-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 71, 111, 0.4);
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

            .btn-add {
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
            
            .action-buttons {
                flex-direction: column;
                gap: 10px;
            }
            
            .status-actions {
                border-right: none;
                border-bottom: 2px solid #e8e8e8;
                padding-right: 0;
                padding-bottom: 10px;
                justify-content: center;
            }
            
            .main-actions {
                justify-content: center;
            }
            
            .btn-action, .btn-status {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 576px) {
            .info-card {
                padding: 15px;
            }
            
            .info-icon {
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
            document.getElementById('statusFilter').addEventListener('change', filterByStatus);
            document.getElementById('prevBtn').addEventListener('click', previousPage);
            document.getElementById('nextBtn').addEventListener('click', nextPage);
            // Hapus event listener untuk refreshBtn
            
            // Delete buttons
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const queueNumber = this.dataset.queue;
                    confirmDelete(id, queueNumber);
                });
            });
            
            // Status buttons
            document.querySelectorAll('.btn-status').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const status = this.dataset.status;
                    updateStatus(id, status);
                });
            });
            
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

        // Filter by Status
        function filterByStatus() {
            const statusFilter = document.getElementById('statusFilter').value;
            
            if (!statusFilter) {
                filteredRows = [...allRows];
            } else {
                filteredRows = allRows.filter(row => {
                    return row.dataset.status === statusFilter;
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

        // Hapus fungsi refreshData

        // Update status via AJAX
        function updateStatus(id, status) {
            if (!confirm('Apakah Anda yakin ingin mengubah status janji temu?')) {
                return;
            }

            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('status', status);

            fetch(`/resepsionis/temu-dokter/${id}/status`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    const row = document.querySelector(`tr[data-status] button[data-id="${id}"]`).closest('tr');
                    const statusBadge = row.querySelector('.status-badge');
                    
                    // Update status badge
                    statusBadge.className = `status-badge status-${data.warna_status}`;
                    statusBadge.innerHTML = `<i class="bi bi-circle-fill"></i> ${data.status_lengkap}`;
                    
                    // Update data attribute
                    row.dataset.status = status;
                    
                    // Update active status buttons
                    row.querySelectorAll('.btn-status').forEach(btn => {
                        btn.classList.remove('active');
                        if (btn.dataset.status === status) {
                            btn.classList.add('active');
                        }
                    });
                    
                    showToast('success', 'Status berhasil diperbarui!');
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Gagal memperbarui status: ' + error.message);
            });
        }

        // Modal Functions
        function confirmDelete(id, queueNumber) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            const queueElement = document.getElementById('deleteQueueNumber');
            
            form.action = `/resepsionis/temu-dokter/${id}`;
            queueElement.textContent = queueNumber;
            modal.show();
        }

        // Toast notification
        function showToast(type, message) {
            // Create toast container if not exists
            let toastContainer = document.getElementById('toastContainer');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toastContainer';
                toastContainer.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    max-width: 400px;
                `;
                document.body.appendChild(toastContainer);
            }

            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show`;
            toast.style.cssText = `
                margin-bottom: 10px;
                animation: slideInRight 0.3s ease;
            `;
            
            const icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill';
            const iconColor = type === 'success' ? 'var(--success)' : 'var(--danger)';
            
            toast.innerHTML = `
                <div class="alert-content">
                    <div class="alert-icon" style="background: ${iconColor};">
                        <i class="bi ${icon}"></i>
                    </div>
                    <div class="alert-text">
                        <strong>${type === 'success' ? 'Berhasil!' : 'Error!'}</strong>
                        <p>${message}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            toastContainer.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        }

        // Hapus style untuk spin animation
    </script>
@endsection