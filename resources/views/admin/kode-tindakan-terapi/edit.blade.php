{{-- views/admin/kode-tindakan-terapi/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Kode Tindakan Terapi - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Kode Tindakan Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kode-tindakan-terapi.index') }}">Data Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
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
                <div class="current-value-body">
                    <div class="current-value-grid">
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-code-slash"></i>
                                <span>Kode</span>
                            </div>
                            <div class="current-value-display">
                                {{ $kodeTindakanTerapi->kode }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-file-text"></i>
                                <span>Deskripsi</span>
                            </div>
                            <div class="current-value-display">
                                {{ Str::limit($kodeTindakanTerapi->deskripsi_tindakan_terapi, 50) }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-folder-fill"></i>
                                <span>Kategori</span>
                            </div>
                            <div class="current-value-display">
                                {{ $kodeTindakanTerapi->nama_kategori }}
                            </div>
                        </div>
                        <div class="current-value-item">
                            <div class="current-value-label">
                                <i class="bi bi-hospital-fill"></i>
                                <span>Kategori Klinis</span>
                            </div>
                            <div class="current-value-display">
                                {{ $kodeTindakanTerapi->nama_kategori_klinis }}
                            </div>
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
                    <p>Pastikan kode yang baru tidak duplikat dengan data yang sudah ada untuk menghindari konflik data dalam sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Kode Tindakan Terapi</h5>
                        <p>Perbarui data kode tindakan terapi dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="kode" class="form-label">
                                    <i class="bi bi-code-slash me-2"></i>
                                    Kode Baru
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" 
                                           id="kode" 
                                           name="kode" 
                                           class="form-control @error('kode') is-invalid @enderror" 
                                           value="{{ old('kode', $kodeTindakanTerapi->kode) }}" 
                                           placeholder="Masukkan kode baru"
                                           maxlength="5"
                                           autofocus>
                                    <div class="input-icon">
                                        <i class="bi bi-tag-fill"></i>
                                    </div>
                                </div>
                                @error('kode')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="idkategori" class="form-label">
                                    <i class="bi bi-folder-fill me-2"></i>
                                    Kategori Baru
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select id="idkategori" 
                                            name="idkategori" 
                                            class="form-control @error('idkategori') is-invalid @enderror">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($kategori as $kat)
                                            <option value="{{ $kat->idkategori }}" {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $kat->idkategori ? 'selected' : '' }}>
                                                {{ $kat->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-list-ul"></i>
                                    </div>
                                </div>
                                @error('idkategori')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi_tindakan_terapi" class="form-label">
                                <i class="bi bi-file-text-fill me-2"></i>
                                Deskripsi Tindakan/Terapi Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <textarea id="deskripsi_tindakan_terapi" 
                                          name="deskripsi_tindakan_terapi" 
                                          class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                          placeholder="Masukkan deskripsi baru"
                                          rows="4">{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}</textarea>
                                <div class="input-icon textarea-icon">
                                    <i class="bi bi-card-text"></i>
                                </div>
                            </div>
                            @error('deskripsi_tindakan_terapi')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="idkategori_klinis" class="form-label">
                                <i class="bi bi-hospital-fill me-2"></i>
                                Kategori Klinis Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idkategori_klinis" 
                                        name="idkategori_klinis" 
                                        class="form-control @error('idkategori_klinis') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori Klinis --</option>
                                    @foreach($kategoriKlinis as $klinis)
                                        <option value="{{ $klinis->idkategori_klinis }}" {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $klinis->idkategori_klinis ? 'selected' : '' }}>
                                            {{ $klinis->nama_kategori_klinis }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-capsule"></i>
                                </div>
                            </div>
                            @error('idkategori_klinis')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
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
                                            <span class="field-label">Kode:</span>
                                            <span class="field-value">{{ $kodeTindakanTerapi->kode }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Deskripsi:</span>
                                            <span class="field-value">{{ Str::limit($kodeTindakanTerapi->deskripsi_tindakan_terapi, 40) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Kategori:</span>
                                            <span class="field-value">{{ $kodeTindakanTerapi->nama_kategori }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Klinis:</span>
                                            <span class="field-value">{{ $kodeTindakanTerapi->nama_kategori_klinis }}</span>
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
                                            <span class="field-label">Kode:</span>
                                            <span class="field-value" id="newKodePreview">{{ old('kode', $kodeTindakanTerapi->kode) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Deskripsi:</span>
                                            <span class="field-value" id="newDescPreview">{{ old('deskripsi_tindakan_terapi', Str::limit($kodeTindakanTerapi->deskripsi_tindakan_terapi, 40)) }}</span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Kategori:</span>
                                            <span class="field-value" id="newKategoriPreview">
                                                @php
                                                    $selectedKategori = $kategori->firstWhere('idkategori', old('idkategori', $kodeTindakanTerapi->idkategori));
                                                @endphp
                                                {{ $selectedKategori ? $selectedKategori->nama_kategori : $kodeTindakanTerapi->nama_kategori }}
                                            </span>
                                        </div>
                                        <div class="comparison-field">
                                            <span class="field-label">Klinis:</span>
                                            <span class="field-value" id="newKlinisPreview">
                                                @php
                                                    $selectedKlinis = $kategoriKlinis->firstWhere('idkategori_klinis', old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis));
                                                @endphp
                                                {{ $selectedKlinis ? $selectedKlinis->nama_kategori_klinis : $kodeTindakanTerapi->nama_kategori_klinis }}
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
                            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary btn-cancel">
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
        .current-value-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .current-value-item {
            margin-bottom: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .textarea-icon {
            top: 20px;
            transform: none;
        }

        .comparison-content {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .comparison-field {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 10px;
        }

        .field-label {
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 600;
            min-width: 60px;
        }

        .field-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-dark);
            text-align: right;
            flex: 1;
        }

        /* Include all existing styles from jenis-hewan edit.blade.php */
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

        .current-value-body {
            padding: 25px;
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
            background: white;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1.2rem;
            font-weight: 700;
            color: #023e8a;
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
            align-items: center;
        }

        .comparison-item {
            background: white;
            border-radius: 12px;
            padding: 15px;
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
            margin-bottom: 10px;
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

        .comparison-arrow {
            color: #0077b6;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
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

        /* Select Styling */
        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23ffa500' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 20px;
            padding-right: 45px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .current-value-header,
            .warning-card {
                flex-direction: column;
                text-align: center;
            }

            .form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .form-card .card-body {
                padding: 30px 20px;
            }

            .current-value-grid,
            .form-grid {
                grid-template-columns: 1fr;
            }

            .comparison-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .comparison-arrow {
                transform: rotate(90deg);
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
        const kodeInput = document.getElementById('kode');
        kodeInput.focus();
        kodeInput.select();

        // Auto uppercase kode
        kodeInput.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
            updatePreview('kode', this.value);
        });

        // Live preview of new values
        document.getElementById('deskripsi_tindakan_terapi').addEventListener('input', function() {
            updatePreview('desc', this.value);
        });

        document.getElementById('idkategori').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            updatePreview('kategori', selectedOption.text);
        });

        document.getElementById('idkategori_klinis').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            updatePreview('klinis', selectedOption.text);
        });

        function updatePreview(type, value) {
    const previewElement = document.getElementById(`new${type.charAt(0).toUpperCase() + type.slice(1)}Preview`);
    if (previewElement) {
        // Default values for each type
        const defaultValues = {
            'kode': '{{ $kodeTindakanTerapi->kode }}',
            'desc': '{{ Str::limit($kodeTindakanTerapi->deskripsi_tindakan_terapi, 40) }}',
            'kategori': '{{ $kodeTindakanTerapi->nama_kategori }}',
            'klinis': '{{ $kodeTindakanTerapi->nama_kategori_klinis }}'
        };
        
        previewElement.textContent = value || defaultValues[type] || '';
    }
}

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const requiredFields = ['kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'];
            let hasError = false;

            requiredFields.forEach(fieldName => {
                const field = document.getElementById(fieldName);
                if (field && field.value.trim() === '') {
                    field.classList.add('is-invalid');
                    if (!field.parentNode.querySelector('.invalid-feedback')) {
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                        errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Field ini wajib diisi!</span>';
                        field.parentNode.appendChild(errorDiv);
                    }
                    hasError = true;
                    
                    if (!field.focused) {
                        field.focus();
                        field.focused = true;
                    }
                }
            });

            if (hasError) {
                e.preventDefault();
            }
        });

        // Remove error class on input
        document.querySelectorAll('.form-control').forEach(field => {
            field.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                const customError = this.parentNode.querySelector('.invalid-feedback');
                if (customError && !this.parentNode.querySelector('.is-invalid')) {
                    customError.remove();
                }
            });
            
            field.addEventListener('change', function() {
                this.classList.remove('is-invalid');
                const customError = this.parentNode.querySelector('.invalid-feedback');
                if (customError && !this.parentNode.querySelector('.is-invalid')) {
                    customError.remove();
                }
            });
        });
    </script>
@endsection