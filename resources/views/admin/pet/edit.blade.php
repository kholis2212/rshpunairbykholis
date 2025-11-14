{{-- views/admin/pet/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Pet - RSHP UNAIR')

@section('page-icon', 'pencil-square')
@section('page-title', 'Edit Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
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
                <div class="current-value-body">
                    <div class="current-value-label">
                        <i class="bi bi-paw-fill"></i>
                        <span>Nama Pet</span>
                    </div>
                    <div class="current-value-display">
                        {{ $pet->nama }}
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
                    <p>Pastikan data yang diperbarui sesuai dengan informasi terbaru dari pemilik untuk menghindari kesalahan dalam sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Pet</h5>
                        <p>Perbarui data pet dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="nama" class="form-label">
                                <i class="bi bi-paw-fill me-2"></i>
                                Nama Pet Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama', $pet->nama) }}" 
                                       placeholder="Masukkan nama pet baru"
                                       autofocus>
                                <div class="input-icon">
                                    <i class="bi bi-tag-fill"></i>
                                </div>
                            </div>
                            @error('nama')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Ubah nama pet sesuai dengan kebutuhan sistem</span>
                            </div>
                        </div>

                        <div class="form-grid">
                            <!-- Tanggal Lahir -->
                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">
                                    <i class="bi bi-calendar-event me-2"></i>
                                    Tanggal Lahir Baru
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="date" 
                                           id="tanggal_lahir" 
                                           name="tanggal_lahir" 
                                           class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}"
                                           max="{{ date('Y-m-d') }}">
                                    <div class="input-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </div>
                                </div>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="bi bi-gender-ambiguous me-2"></i>
                                    Jenis Kelamin Baru
                                    <span class="required">*</span>
                                </label>
                                <div class="radio-group">
                                    <div class="radio-option">
                                        <input type="radio" 
                                               id="jantan" 
                                               name="jenis_kelamin" 
                                               value="L" 
                                               {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'L' ? 'checked' : '' }}
                                               class="form-check-input">
                                        <label for="jantan" class="form-check-label">
                                            <i class="bi bi-gender-male"></i>
                                            <span>Jantan</span>
                                        </label>
                                    </div>
                                    <div class="radio-option">
                                        <input type="radio" 
                                               id="betina" 
                                               name="jenis_kelamin" 
                                               value="P" 
                                               {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'P' ? 'checked' : '' }}
                                               class="form-check-input">
                                        <label for="betina" class="form-check-label">
                                            <i class="bi bi-gender-female"></i>
                                            <span>Betina</span>
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Warna/Tanda -->
                        <div class="form-group">
                            <label for="warna_tanda" class="form-label">
                                <i class="bi bi-palette me-2"></i>
                                Warna/Tanda Khusus Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       id="warna_tanda" 
                                       name="warna_tanda" 
                                       class="form-control @error('warna_tanda') is-invalid @enderror" 
                                       value="{{ old('warna_tanda', $pet->warna_tanda) }}" 
                                       placeholder="Contoh: Coklat muda dengan bercak putih di dada">
                                <div class="input-icon">
                                    <i class="bi bi-brush-fill"></i>
                                </div>
                            </div>
                            @error('warna_tanda')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Ras Hewan -->
                        <div class="form-group">
                            <label for="idras_hewan" class="form-label">
                                <i class="bi bi-tags me-2"></i>
                                Ras Hewan Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idras_hewan" 
                                        name="idras_hewan" 
                                        class="form-control @error('idras_hewan') is-invalid @enderror">
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    @foreach($rasHewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" 
                                            {{ old('idras_hewan', $pet->idras_hewan) == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }} ({{ $ras->nama_jenis_hewan }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-card-checklist"></i>
                                </div>
                            </div>
                            @error('idras_hewan')
                                <div class="invalid-feedback d-flex align-items-center gap-2">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        <!-- Pemilik -->
                        <div class="form-group">
                            <label for="idpemilik" class="form-label">
                                <i class="bi bi-person me-2"></i>
                                Pemilik Baru
                                <span class="required">*</span>
                            </label>
                            <div class="input-wrapper">
                                <select id="idpemilik" 
                                        name="idpemilik" 
                                        class="form-control @error('idpemilik') is-invalid @enderror">
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach($pemilik as $owner)
                                        <option value="{{ $owner->idpemilik }}" 
                                            {{ old('idpemilik', $pet->idpemilik) == $owner->idpemilik ? 'selected' : '' }}>
                                            {{ $owner->nama }} ({{ $owner->no_wa }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-icon">
                                    <i class="bi bi-person-check-fill"></i>
                                </div>
                            </div>
                            @error('idpemilik')
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
                                    <div class="comparison-value">
                                        <strong>{{ $pet->nama }}</strong><br>
                                        {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}<br>
                                        {{ $pet->warna_tanda }}
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
                                    <div class="comparison-value" id="newValuePreview">
                                        <strong id="previewNama">{{ old('nama', $pet->nama) }}</strong><br>
                                        <span id="previewTanggal">{{ old('tanggal_lahir', $pet->tanggal_lahir) ? \Carbon\Carbon::parse(old('tanggal_lahir', $pet->tanggal_lahir))->format('d/m/Y') : '' }}</span><br>
                                        <span id="previewWarna">{{ old('warna_tanda', $pet->warna_tanda) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Data</span>
                            </button>
                            <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary btn-cancel">
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

        /* Radio Group Styles */
        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            background: var(--light-bg);
            cursor: pointer;
            transition: all 0.3s ease;
            flex: 1;
        }

        .radio-option:hover {
            border-color: var(--warning);
            background: #fff8e6;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .radio-option label {
            margin: 0;
            cursor: pointer;
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .radio-option input[type="radio"]:checked + label {
            color: var(--warning);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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

        .comparison-value {
            font-size: 1rem;
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

            .form-card .card-header {
                flex-direction: column;
                text-align: center;
                padding: 25px 20px;
            }

            .form-card .card-body {
                padding: 30px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .radio-group {
                flex-direction: column;
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
        const input = document.getElementById('nama');
        input.focus();
        input.select();

        // Live preview of new values
        document.getElementById('nama').addEventListener('input', function() {
            const newValue = this.value.trim() || '{{ $pet->nama }}';
            document.getElementById('previewNama').textContent = newValue;
        });

        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            const date = new Date(this.value);
            const formattedDate = this.value ? date.toLocaleDateString('id-ID') : '{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format("d/m/Y") }}';
            document.getElementById('previewTanggal').textContent = formattedDate;
        });

        document.getElementById('warna_tanda').addEventListener('input', function() {
            const newValue = this.value.trim() || '{{ $pet->warna_tanda }}';
            document.getElementById('previewWarna').textContent = newValue;
        });

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            if (input.value.trim() === '') {
                e.preventDefault();
                input.classList.add('is-invalid');
                
                // Tambahkan pesan error jika belum ada
                if (!document.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Nama pet wajib diisi!</span>';
                    input.parentNode.appendChild(errorDiv);
                }
                
                input.focus();
            }
        });

        // Remove error class on input
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            // Hapus pesan error custom jika ada
            const customError = this.parentNode.querySelector('.invalid-feedback');
            if (customError && !this.parentNode.querySelector('.is-invalid')) {
                customError.remove();
            }
        });

        // Set max date to today
        document.getElementById('tanggal_lahir').max = new Date().toISOString().split('T')[0];
    </script>
@endsection