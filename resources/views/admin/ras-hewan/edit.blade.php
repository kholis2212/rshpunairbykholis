{{-- views/admin/ras-hewan/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Ras Hewan - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Ras Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.ras-hewan.index') }}">Data Ras Hewan</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Current Value Card -->
            <div class="current-value-card mb-4">
                <div class="current-value-header">
                    <div class="current-value-icon">
                        <i class="bi bi-file-text-fill"></i>
                    </div>
                    <div class="current-value-text">
                        <h6>Nilai Saat Ini</h6>
                        <p>Data yang sedang aktif dalam sistem</p>
                    </div>
                </div>
                <div class="current-value-grid">
                    <div class="current-value-item">
                        <div class="current-value-label">
                            <i class="bi bi-tags-fill"></i>
                            <span>Jenis Hewan</span>
                        </div>
                        <div class="current-value-display">
                          @php
                            $currentJenis = collect($jenisHewan)->firstWhere('idjenis_hewan', $rasHewan->idjenis_hewan);
                          @endphp
                           {{ $currentJenis ? $currentJenis->nama_jenis_hewan : '-' }}
                        </div>
                    </div>
                    <div class="current-value-item">
                        <div class="current-value-label">
                            <i class="bi bi-paw-fill"></i>
                            <span>Nama Ras</span>
                        </div>
                        <div class="current-value-display">
                            {{ $rasHewan->nama_ras }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Card -->
            <div class="warning-card mb-4">
                <div class="warning-card-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="warning-card-content">
                    <h6>Perhatian!</h6>
                    <p>Pastikan kombinasi jenis hewan dan nama ras yang baru tidak duplikat dengan data yang sudah ada untuk menghindari konflik data dalam sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Ras Hewan</h5>
                        <p>Perbarui data ras hewan dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="idjenis_hewan" class="form-label">
                                <i class="bi bi-tags-fill me-2"></i>
                                Jenis Hewan Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idjenis_hewan" 
                                        name="idjenis_hewan" 
                                        class="form-control @error('idjenis_hewan') is-invalid @enderror">
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    @foreach($jenisHewan as $jenis)
                                        <option value="{{ $jenis->idjenis_hewan }}" 
                                            {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                            {{ $jenis->nama_jenis_hewan }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-chevron-down"></i>
                                </div>
                            </div>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_ras" class="form-label">
                                <i class="bi bi-paw-fill me-2"></i>
                                Nama Ras Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="nama_ras" 
                                       name="nama_ras" 
                                       class="form-control @error('nama_ras') is-invalid @enderror" 
                                       value="{{ old('nama_ras', $rasHewan->nama_ras) }}" 
                                       placeholder="Masukkan nama ras baru"
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-tag-fill"></i>
                                </div>
                            </div>
                            @error('nama_ras')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Ubah nama ras hewan sesuai dengan kebutuhan sistem</span>
                            </div>
                        </div>

                        <div class="comparison-section">
                            <div class="comparison-header">
                                <i class="bi bi-arrow-left-right"></i>
                                <span>Perbandingan Data</span>
                            </div>
                            <div class="comparison-grid">
                                <div class="comparison-item comparison-old">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-text"></i>
                                        <span>Data Lama</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis Hewan:</span>
                                            <span class="field-value">
                                            {{ $rasHewan->nama_jenis_hewan ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Nama Ras:</span>
                                            <span class="field-value">{{ $rasHewan->nama_ras }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="comparison-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                                <div class="comparison-item comparison-new">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-earmark-check"></i>
                                        <span>Data Baru</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Jenis Hewan:</span>
                                            <span class="field-value" id="newJenisPreview">
                                                @php
                                                    $selectedJenis = $jenisHewan->firstWhere('idjenis_hewan', old('idjenis_hewan', $rasHewan->idjenis_hewan));
                                                    echo $selectedJenis ? $selectedJenis->nama_jenis_hewan : $rasHewan->jenisHewan->nama_jenis_hewan;
                                                @endphp
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Nama Ras:</span>
                                            <span class="field-value" id="newRasPreview">
                                                {{ old('nama_ras', $rasHewan->nama_ras) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Data</span>
                            </button>
                            <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary btn-cancel">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Current Value Card */
        .current-value-card {
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            overflow: hidden;
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

        .current-value-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-value-icon {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            backdrop-filter: blur(10px);
        }

        .current-value-text h6 {
            margin: 0 0 3px 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .current-value-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .current-value-grid {
            padding: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .current-value-item {
            background: white;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 20px;
        }

        .current-value-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 12px;
        }

        .current-value-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .current-value-display {
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
        }

        /* Warning Card */
        .warning-card {
            background: linear-gradient(135deg, rgba(255, 165, 0, 0.05), rgba(255, 140, 0, 0.05));
            border: 2px solid rgba(255, 165, 0, 0.3);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
            animation: slideDown 0.6s ease;
        }

        .warning-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .warning-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #ff8c00;
            margin: 0 0 5px 0;
        }

        .warning-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 165, 0, 0.15);
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

        .form-card .card-header {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: white;
            padding: 30px;
            border: none;
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .card-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .card-header-text h5 {
            margin: 0 0 5px 0;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .card-header-text p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .form-card .card-body {
            padding: 40px;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
        }

        .required {
            color: #ef476f;
            margin-left: 5px;
            font-size: 1.1rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            padding: 14px 50px 14px 18px;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #f8fbff;
        }

        .form-control:focus {
            border-color: #ffa500;
            background: white;
            box-shadow: 0 0 0 4px rgba(255, 165, 0, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #ffa500;
            font-size: 1.2rem;
            pointer-events: none;
        }

        .form-control.is-invalid {
            border-color: #ef476f;
            background: #fff5f5;
            padding-right: 50px;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 71, 111, 0.1);
        }

        .invalid-feedback {
            color: #ef476f;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
            display: flex !important;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .form-hint {
            background: #fff8e6;
            border-left: 3px solid #ffa500;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 12px;
            display: flex;
            align-items: start;
            gap: 10px;
            color: var(--text-gray);
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .form-hint i {
            color: #ffa500;
            font-size: 1rem;
            margin-top: 2px;
        }

        /* Comparison Section */
        .comparison-section {
            background: #f8fbff;
            border: 2px dashed #0077b6;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .comparison-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 20px;
        }

        .comparison-header i {
            color: #0077b6;
            font-size: 1.2rem;
        }

        .comparison-grid {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            gap: 20px;
            align-items: start;
        }

        .comparison-item {
            background: white;
            border-radius: 12px;
            padding: 20px;
            height: 100%;
        }

        .comparison-old {
            border: 2px solid #e8e8e8;
        }

        .comparison-new {
            border: 2px solid #06d6a0;
        }

        .comparison-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .comparison-label i {
            font-size: 1rem;
        }

        .comparison-old .comparison-label {
            color: #ef476f;
        }

        .comparison-old .comparison-label i {
            color: #ef476f;
        }

        .comparison-new .comparison-label {
            color: #06d6a0;
        }

        .comparison-new .comparison-label i {
            color: #06d6a0;
        }

        .comparison-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .comparison-field {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #4a5568;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .field-value {
            font-size: 0.9rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
        }

        .comparison-arrow {
            color: #0077b6;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding-top: 40px;
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 2px solid #f8fbff;
        }

        .btn-submit {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
        }

        .btn-cancel {
            background: #f8fbff;
            color: #4a5568;
            border: 2px solid #e8e8e8;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            flex: 1;
            justify-content: center;
        }

        .btn-cancel:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
            color: #4a5568;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .current-value-header,
            .warning-card {
                flex-direction: column;
                text-align: center;
            }

            .current-value-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .form-card .card-body {
                padding: 30px 20px;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .comparison-arrow {
                transform: rotate(90deg);
                padding: 0;
                height: auto;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        // Auto focus and select all text
        const inputRas = document.getElementById('nama_ras');
        inputRas.focus();
        inputRas.select();

        // Live preview of new values
        inputRas.addEventListener('input', function() {
            const newValue = this.value.trim() || '{{ $rasHewan->nama_ras }}';
            document.getElementById('newRasPreview').textContent = newValue;
        });

        document.getElementById('idjenis_hewan').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const newValue = selectedOption.text || '-';
            document.getElementById('newJenisPreview').textContent = newValue;
        });

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const selectJenis = document.getElementById('idjenis_hewan');
            let hasError = false;

            if (selectJenis.value === '') {
                selectJenis.classList.add('is-invalid');
                hasError = true;
            }

            if (inputRas.value.trim() === '') {
                inputRas.classList.add('is-invalid');
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                
                // Tambahkan pesan error custom jika belum ada
                if (selectJenis.value === '' && !selectJenis.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Jenis hewan wajib dipilih!</span>';
                    selectJenis.parentNode.appendChild(errorDiv);
                }

                if (inputRas.value.trim() === '' && !inputRas.parentNode.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nama ras wajib diisi!</span>';
                    inputRas.parentNode.appendChild(errorDiv);
                }

                if (selectJenis.value === '') {
                    selectJenis.focus();
                } else {
                    inputRas.focus();
                }
            }
        });

        // Remove error class on change/input
        document.getElementById('idjenis_hewan').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            // Hapus pesan error custom jika ada
            const customError = this.parentNode.querySelector('.invalid-feedback');
            if (customError && !this.parentNode.querySelector('.is-invalid')) {
                customError.remove();
            }
        });

        inputRas.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            // Hapus pesan error custom jika ada
            const customError = this.parentNode.querySelector('.invalid-feedback');
            if (customError && !this.parentNode.querySelector('.is-invalid')) {
                customError.remove();
            }
        });
    </script>
@endsection