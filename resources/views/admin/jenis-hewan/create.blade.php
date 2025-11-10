@extends('layouts.lte.main')

@section('title', 'Tambah Jenis Hewan - RSHP UNAIR')

@section('page-title', 'Tambah Jenis Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jenis-hewan.index') }}">Data Jenis Hewan</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Form Card -->
            <div class="card" style="border-radius: 20px; border: 3px solid #0077b6; box-shadow: 0 10px 40px rgba(0,0,0,0.1);">
                <!-- Card Header -->
                <div class="card-header" style="background: linear-gradient(135deg, #0077b6, #00b4d8); border-radius: 17px 17px 0 0; padding: 30px;">
                    <div class="text-center">
                        <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto 20px; backdrop-filter: blur(10px); box-shadow: 0 5px 20px rgba(0,0,0,0.2);">
                            🐾
                        </div>
                        <h3 class="card-title mb-2" style="font-size: 1.8rem; font-weight: 800; margin: 0;">
                            Tambah Jenis Hewan
                        </h3>
                        <p style="margin: 0; opacity: 0.95; font-size: 1rem;">
                            Isi formulir di bawah untuk menambah data jenis hewan baru
                        </p>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body" style="padding: 35px;">
                    <!-- Info Box -->
                    <div class="alert" style="background: linear-gradient(135deg, #f0f9ff, #e3f2fd); border-left: 5px solid #0077b6; border-radius: 12px; padding: 20px; margin-bottom: 30px; display: flex; align-items: start; gap: 15px;">
                        <div style="font-size: 1.8rem;">💡</div>
                        <div>
                            <strong style="color: #023e8a; font-size: 1.05rem;">Petunjuk Pengisian:</strong>
                            <p style="margin: 5px 0 0; color: #4a5568; line-height: 1.6;">
                                Pastikan nama jenis hewan yang Anda masukkan belum terdaftar dalam sistem dan menggunakan huruf kapital pada awal kata.
                            </p>
                        </div>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label for="nama_jenis_hewan" style="font-weight: 700; color: #1a1a2e; font-size: 1.05rem; margin-bottom: 10px;">
                                Nama Jenis Hewan
                                <span style="color: #ef476f;">*</span>
                            </label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); font-size: 1.5rem; z-index: 10;">🐾</span>
                                <input type="text" 
                                       id="nama_jenis_hewan" 
                                       name="nama_jenis_hewan" 
                                       class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                                       value="{{ old('nama_jenis_hewan') }}" 
                                       placeholder="Contoh: Kucing, Anjing, Burung"
                                       style="padding: 14px 18px 14px 55px; border: 2px solid #e8e8e8; border-radius: 12px; font-size: 1rem; transition: all 0.3s ease;"
                                       autofocus
                                       required>
                            </div>
                            @error('nama_jenis_hewan')
                                <div class="invalid-feedback" style="display: flex; align-items: center; gap: 8px; font-size: 0.9rem; margin-top: 8px; color: #ef476f; font-weight: 600;">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" class="btn btn-primary" style="flex: 1; padding: 14px; font-size: 1.05rem; font-weight: 700;">
                                <i class="bi bi-save"></i> Simpan Data
                            </button>
                            <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary" style="flex: 1; padding: 14px; font-size: 1.05rem; font-weight: 700; background: #6c757d; border: none;">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            border-color: #0077b6 !important;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.15) !important;
        }
        
        .form-control.is-invalid {
            border-color: #ef476f !important;
            background: #fff5f7 !important;
        }
        
        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.15) !important;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection

@section('extra-js')
<script>
    // Auto focus on input
    document.getElementById('nama_jenis_hewan').focus();

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const input = document.getElementById('nama_jenis_hewan');
        if (input.value.trim() === '') {
            e.preventDefault();
            input.classList.add('is-invalid');
            input.focus();
        }
    });

    // Remove error class on input
    document.getElementById('nama_jenis_hewan').addEventListener('input', function() {
        this.classList.remove('is-invalid');
    });
</script>
@endsection