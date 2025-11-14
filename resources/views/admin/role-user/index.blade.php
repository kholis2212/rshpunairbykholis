{{-- views/admin/role-user/index.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Manajemen Role User - RSHP UNAIR')

@section('page-icon', 'person-gear')
@section('page-title', 'Manajemen Role User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen Role User</li>
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

    <!-- Alert Error -->
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

    <!-- Info Banner -->
    <div class="info-banner mb-4">
        <div class="info-banner-icon">
            <i class="bi bi-info-circle-fill"></i>
        </div>
        <div class="info-banner-content">
            <h6>Tentang Manajemen Role User</h6>
            <p>Kelola hak akses dan peran pengguna sistem RSHP UNAIR untuk mengatur akses ke berbagai fitur sistem</p>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card main-card">
        <div class="card-header">
            <div class="card-header-left">
                <div class="header-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="header-text">
                    <h5>Daftar User & Role</h5>
                    <p>Total: <span class="badge badge-count">{{ $users->count() }}</span> user terdaftar</p>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($users->count() > 0)
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
                                        <option value="75">75</option>
                                        <option value="100">100</option>
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
                            <input type="text" id="searchInput" placeholder="Cari user atau role...">
                        </div>
                    </div>
                    
                    <div class="controls-right">
                        <!-- Add Button -->
                        <a href="{{ route('admin.role-user.create') }}" class="btn-add">
                            <i class="bi bi-person-plus-fill"></i>
                            <span class="btn-text">Tambah Role</span>
                        </a>
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
                                        <i class="bi bi-person-fill"></i>
                                        <span>Nama User</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span>Email</span>
                                    </div>
                                </th>
                                <th>
                                    <div class="th-content">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Role yang Dimiliki</span>
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
                            @foreach($users as $index => $user)
                            @php
                                $roleNames = $user->role_names ? explode(',', $user->role_names) : [];
                                $roleUserIds = $user->role_user_ids ? explode(',', $user->role_user_ids) : [];
                            @endphp
                            <tr>
                                <td>
                                    <span class="badge-number">{{ $index + 1 }}</span>
                                </td>
                                <td>
                                    <div class="table-main-info">
                                        <span>{{ $user->nama }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-email">{{ $user->email }}</span>
                                </td>
                                <td>
                                    @if(count($roleNames) > 0)
                                        @foreach($roleNames as $index => $role)
                                            <div class="role-item-with-action">
                                                <span class="badge-role badge-{{ strtolower(str_replace(' ', '', $role)) }}">
                                                    <i class="bi bi-shield-check me-1"></i>
                                                    {{ $role }}
                                                </span>
                                                @if(isset($roleUserIds[$index]))
                                                <form action="{{ route('admin.role-user.destroy', $roleUserIds[$index]) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form"
                                                      data-role="{{ $role }}"
                                                      data-user="{{ $user->nama }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-delete-role" 
                                                            data-bs-toggle="tooltip" 
                                                            title="Hapus role {{ $role }}">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Belum ada role</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.role-user.edit', $user->iduser) }}" 
                                           class="btn-action btn-edit" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit Role">
                                            <i class="bi bi-pencil-square"></i>
                                            <span class="btn-text">Edit</span>
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
                        <span id="showingText">Menampilkan 1 hingga {{ min(10, $users->count()) }} dari {{ $users->count() }} data</span>
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
                        <i class="bi bi-people"></i>
                    </div>
                    <h4>Belum Ada Data</h4>
                    <p>Silakan tambahkan role user terlebih dahulu untuk memulai</p>
                    <a href="{{ route('admin.role-user.create') }}" class="btn-empty">
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Tambah Role Pertama</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-header-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="modal-header-text">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Role</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus role <strong id="deleteRoleName"></strong> dari user <strong id="deleteUserName"></strong>?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan!</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle-fill"></i>
                        Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash-fill"></i>
                            Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Role Item with Action */
        .role-item-with-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin: 2px 5px 2px 0;
            position: relative;
        }

        .btn-delete-role {
            background: none;
            border: none;
            color: #ef476f;
            cursor: pointer;
            padding: 2px 5px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .btn-delete-role:hover {
            background: #ef476f;
            color: white;
            opacity: 1;
            transform: scale(1.1);
        }

        /* Badge Role Styles */
        .badge-role {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-administrator {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: white;
        }

        .badge-dokter {
            background: linear-gradient(135deg, #0077b6, #00b4d8);
            color: white;
        }

        .badge-perawat {
            background: linear-gradient(135deg, #06d6a0, #05b589);
            color: white;
        }

        .badge-resepsionis {
            background: linear-gradient(135deg, #ffc300, #ffdb4d);
            color: #1a1a2e;
        }

        .badge-pemilikanimal {
            background: linear-gradient(135deg, #8338ec, #5a189a);
            color: white;
        }

        /* Default style untuk role lain yang tidak terdefinisi */
        .badge-role:not([class*="badge-administrator"]):not([class*="badge-dokter"]):not([class*="badge-perawat"]):not([class*="badge-resepsionis"]):not([class*="badge-pemilikanimal"]) {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        /* Modal Styles */
        .modal-header {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: white;
            border: none;
            padding: 25px;
        }

        .modal-header-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .modal-header-text {
            flex: 1;
        }

        .modal-title {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 700;
        }

        .modal-body {
            padding: 30px;
            font-size: 1rem;
        }

        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #e8e8e8;
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
            width: 280px;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1);
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

        .table-main-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .text-email {
            color: var(--text-gray);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-action {
            padding: 8px 15px;
            border-radius: 10px;
            border: none;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-edit {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(255, 165, 0, 0.4);
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

        /* Responsive */
        @media (max-width: 768px) {
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

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn-action {
                justify-content: center;
            }

            .badge-role {
                font-size: 0.7rem;
                padding: 4px 8px;
            }

            .role-item-with-action {
                display: flex;
                flex-direction: column;
                align-items: start;
                gap: 2px;
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
            allRows = Array.from(document.querySelectorAll('#tableBody tr'));
            filteredRows = [...allRows];
            
            // Initialize event listeners
            document.getElementById('searchInput').addEventListener('input', searchTable);
            document.getElementById('entriesPerPage').addEventListener('change', changeEntriesPerPage);
            document.getElementById('prevBtn').addEventListener('click', previousPage);
            document.getElementById('nextBtn').addEventListener('click', nextPage);
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialize delete confirmation modal
            initializeDeleteModal();
            
            updatePagination();
        });

        // Delete Confirmation Modal
        function initializeDeleteModal() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const roleName = this.getAttribute('data-role');
                    const userName = this.getAttribute('data-user');
                    
                    document.getElementById('deleteRoleName').textContent = roleName;
                    document.getElementById('deleteUserName').textContent = userName;
                    document.getElementById('deleteForm').action = this.action;
                    
                    deleteModal.show();
                });
            });
            
            // Confirm delete
            document.getElementById('deleteForm').addEventListener('submit', function() {
                deleteModal.hide();
            });
        }

        // Search Function
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            
            filteredRows = allRows.filter(row => {
                const tdNama = row.getElementsByTagName('td')[1];
                const tdEmail = row.getElementsByTagName('td')[2];
                const tdRoles = row.getElementsByTagName('td')[3];
                
                let isMatch = false;
                
                if (tdNama) {
                    const txtNama = tdNama.textContent || tdNama.innerText;
                    isMatch = txtNama.toLowerCase().includes(filter);
                }
                
                if (!isMatch && tdEmail) {
                    const txtEmail = tdEmail.textContent || tdEmail.innerText;
                    isMatch = txtEmail.toLowerCase().includes(filter);
                }
                
                if (!isMatch && tdRoles) {
                    const txtRoles = tdRoles.textContent || tdRoles.innerText;
                    isMatch = txtRoles.toLowerCase().includes(filter);
                }
                
                return isMatch;
            });
            
            currentPage = 1;
            updatePagination();
        }

        // Change entries per page
        function changeEntriesPerPage() {
            entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
            currentPage = 1;
            updatePagination();
        }

        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
            const start = (currentPage - 1) * entriesPerPage;
            const end = start + entriesPerPage;

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