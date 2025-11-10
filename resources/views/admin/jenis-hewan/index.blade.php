@extends('layouts.lte.main')

@section('title', 'Data Jenis Hewan - RSHP UNAIR')

@section('page-title', 'Data Jenis Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Jenis Hewan</li>
@endsection

@section('content')
    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: flex; align-items: center; gap: 12px;">
            <i class="bi bi-check-circle-fill" style="font-size: 1.5rem;"></i>
            <div style="flex: 1;">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: flex; align-items: center; gap: 12px;">
            <i class="bi bi-exclamation-circle-fill" style="font-size: 1.5rem;"></i>
            <div style="flex: 1;">{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <i class="bi bi-heart-fill me-2"></i>
                Daftar Jenis Hewan
            </h3>
            <div class="card-tools">
                <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-plus-circle"></i> Tambah Data
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @if($jenisHewan->count() > 0)
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width: 80px;" class="text-center">No</th>
                                <th>Nama Jenis Hewan</th>
                                <th style="width: 220px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jenisHewan as $index => $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge text-bg-primary" style="font-size: 0.9rem; padding: 8px 12px;">{{ $index + 1 }}</span>
                                </td>
                                <td style="font-weight: 600; font-size: 1.05rem; color: #1a1a2e;">
                                    <i class="bi bi-heart-fill" style="color: #ef476f;"></i> {{ $item->nama_jenis_hewan }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.jenis-hewan.edit', $item->idjenis_hewan) }}" 
                                           class="btn btn-warning btn-sm" 
                                           title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <button type="button" 
                                                class="btn btn-danger btn-sm" 
                                                onclick="confirmDelete({{ $item->idjenis_hewan }}, '{{ $item->nama_jenis_hewan }}')"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div style="font-size: 5rem; opacity: 0.3; animation: float 3s ease-in-out infinite;">
                        🐾
                    </div>
                    <h4 class="text-muted mt-3" style="font-weight: 700;">Belum Ada Data</h4>
                    <p class="text-muted" style="font-size: 1.05rem;">Silakan tambahkan data jenis hewan terlebih dahulu</p>
                    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary mt-3" style="padding: 12px 30px; font-size: 1rem;">
                        <i class="bi bi-plus-circle"></i> Tambah Data Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
                <div class="modal-header" style="background: linear-gradient(135deg, #ef476f, #d62839); color: white; border-radius: 20px 20px 0 0; padding: 25px;">
                    <h5 class="modal-title" id="deleteModalLabel" style="font-weight: 700; font-size: 1.3rem;">
                        <i class="bi bi-exclamation-triangle-fill"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <div class="text-center mb-4">
                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #ef476f, #d62839); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 2.5rem; animation: pulse 1.5s ease infinite;">
                            ⚠️
                        </div>
                    </div>
                    <p style="font-size: 1.1rem; text-align: center; margin-bottom: 15px;">
                        Apakah Anda yakin ingin menghapus jenis hewan<br>
                        <strong style="color: #ef476f; font-size: 1.2rem;" id="deleteItemName"></strong>?
                    </p>
                    <p class="text-danger mb-0" style="text-align: center; font-weight: 600;">
                        <i class="bi bi-info-circle-fill"></i> Data yang dihapus tidak dapat dikembalikan!
                    </p>
                </div>
                <div class="modal-footer" style="padding: 20px 30px; border-top: 1px solid #e8e8e8;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 10px 25px;">
                        <i class="bi bi-x-circle"></i> Batal
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline; margin: 0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="padding: 10px 25px;">
                            <i class="bi bi-trash"></i> Ya, Hapus!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .table tbody tr:hover {
            background: #f0f9ff !important;
            transform: scale(1.01);
            box-shadow: 0 2px 8px rgba(0,119,182,0.1);
        }
    </style>
@endsection

@section('extra-js')
<script>
    function confirmDelete(id, name) {
        const form = document.getElementById('deleteForm');
        const itemName = document.getElementById('deleteItemName');
        
        form.action = `/admin/jenis-hewan/${id}`;
        itemName.textContent = name;
        
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
</script>
@endsection