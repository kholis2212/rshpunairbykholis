{{-- views/resepsionis/temu-dokter/create.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Tambah Jadwal Temu Dokter - RSHP UNAIR')

@section('page-icon', 'calendar-plus-fill')
@section('page-title', 'Tambah Jadwal Temu Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard-resepsionis') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.temu-dokter.index') }}">Temu Dokter</a></li>
    <li class="breadcrumb-item active">Tambah Jadwal</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <!-- Info Card -->
            <div class="info-card mb-4">
                <div class="info-card-icon">
                    <i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="info-card-content">
                    <h6>Informasi Penting</h6>
                    <p>Pastikan pemilik dan hewan peliharaan sudah terdaftar dalam sistem sebelum membuat jadwal temu dokter. 
                       Nomor antrian akan di-generate otomatis berdasarkan urutan pendaftaran hari ini.</p>
                </div>
            </div>

            <!-- Queue Info Card -->
            <div class="queue-info-card mb-4">
                <div class="queue-info-header">
                    <div class="queue-info-icon">
                        <i class="bi bi-123"></i>
                    </div>
                    <div class="queue-info-text">
                        <h6>Nomor Antrian Berikutnya</h6>
                        <p>Sistem akan memberikan nomor antrian secara berurutan</p>
                    </div>
                </div>
                <div class="queue-number-display">
                    <span class="queue-number">{{ $nextQueueNumber }}</span>
                    <span class="queue-label">Antrian Selanjutnya</span>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-calendar-plus-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Tambah Jadwal Temu Dokter</h5>
                        <p>Isi formulir di bawah dengan data yang lengkap dan valid</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST" id="formCreate">
                        @csrf
                        
                        <!-- Section 1: Pilih Pemilik dan Hewan -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Pemilik & Hewan Peliharaan</h6>
                                    <p>Pilih pemilik dan hewan peliharaan yang sudah terdaftar</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="idpemilik" class="form-label">
                                    <i class="bi bi-person-fill me-2"></i>
                                    Pilih Pemilik
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select name="idpemilik" id="idpemilik" class="form-control @error('idpemilik') is-invalid @enderror">
                                        <option value="">Pilih pemilik...</option>
                                        @foreach($pemilik as $p)
                                            <option value="{{ $p->idpemilik }}" 
                                                {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}
                                                data-pets='@json($p->pets)'>
                                                {{ $p->user->nama }} - {{ $p->user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                @error('idpemilik')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="idpet" class="form-label">
                                    <i class="bi bi-paw-fill me-2"></i>
                                    Pilih Hewan Peliharaan
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" disabled>
                                        <option value="">Pilih hewan peliharaan...</option>
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                @error('idpet')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                
                                <div class="pet-info mt-3" id="petInfo" style="display: none;">
                                    <div class="pet-card">
                                        <div class="pet-icon">
                                            <i class="bi bi-heart-fill"></i>
                                        </div>
                                        <div class="pet-details">
                                            <h6 id="petNama">-</h6>
                                            <div class="pet-meta">
                                                <span class="pet-badge" id="petJenis">-</span>
                                                <span class="pet-badge" id="petRas">-</span>
                                                <span class="pet-badge" id="petGender">-</span>
                                                <span class="pet-badge" id="petAge">-</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Pilih Dokter -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Data Dokter</h6>
                                    <p>Pilih dokter yang akan memeriksa</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="idrole_user" class="form-label">
                                    <i class="bi bi-stethoscope me-2"></i>
                                    Pilih Dokter
                                    <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select name="idrole_user" id="idrole_user" class="form-control @error('idrole_user') is-invalid @enderror">
                                        <option value="">Pilih dokter...</option>
                                        @foreach($dokter as $d)
                                            <option value="{{ $d->idrole_user }}" {{ old('idrole_user') == $d->idrole_user ? 'selected' : '' }}>
                                                {{ $d->user->nama }} - {{ $d->user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-icon">
                                        <i class="bi bi-chevron-down"></i>
                                    </div>
                                </div>
                                @error('idrole_user')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                
                                <div class="doctor-info mt-3" id="doctorInfo" style="display: none;">
                                    <div class="doctor-card">
                                        <div class="doctor-icon">
                                            <i class="bi bi-person-check-fill"></i>
                                        </div>
                                        <div class="doctor-details">
                                            <h6 id="doctorNama">-</h6>
                                            <p id="doctorEmail">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Keluhan -->
                        <div class="form-section">
                            <div class="section-header">
                                <div class="section-icon">
                                    <i class="bi bi-chat-left-text-fill"></i>
                                </div>
                                <div class="section-text">
                                    <h6>Informasi Tambahan</h6>
                                    <p>Tambahkan keluhan atau informasi penting lainnya</p>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="keluhan" class="form-label">
                                    <i class="bi bi-clipboard-plus-fill me-2"></i>
                                    Keluhan / Catatan
                                </label>
                                <div class="input-wrapper">
                                    <textarea name="keluhan" id="keluhan" 
                                              class="form-control @error('keluhan') is-invalid @enderror" 
                                              rows="4" 
                                              placeholder="Masukkan keluhan atau catatan penting mengenai kondisi hewan...">{{ old('keluhan') }}</textarea>
                                    <div class="input-icon">
                                        <i class="bi bi-pencil-fill"></i>
                                    </div>
                                </div>
                                @error('keluhan')
                                    <div class="invalid-feedback d-flex align-items-center gap-2">
                                        <i class="bi bi-exclamation-circle-fill"></i>
                                        <span>{{ $message }}</span>
                                    </div>
                                @enderror
                                <div class="form-hint">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <span>Opsional. Digunakan untuk memberikan informasi tambahan kepada dokter</span>
                                </div>
                            </div>
                        </div>

                        <!-- Summary Section -->
                        <div class="summary-section">
                            <div class="summary-header">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Ringkasan Pendaftaran</span>
                            </div>
                            <div class="summary-grid">
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="bi bi-123"></i>
                                        <span>Nomor Antrian</span>
                                    </div>
                                    <div class="summary-value" id="summaryQueue">{{ $nextQueueNumber }}</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="bi bi-person-fill"></i>
                                        <span>Pemilik</span>
                                    </div>
                                    <div class="summary-value" id="summaryPemilik">-</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="bi bi-heart-fill"></i>
                                        <span>Hewan</span>
                                    </div>
                                    <div class="summary-value" id="summaryPet">-</div>
                                </div>
                                <div class="summary-item">
                                    <div class="summary-label">
                                        <i class="bi bi-person-badge"></i>
                                        <span>Dokter</span>
                                    </div>
                                    <div class="summary-value" id="summaryDoctor">-</div>
                                </div>
                            </div>
                            <!-- Keluhan Summary -->
                            <div class="summary-item-full">
                                <div class="summary-label">
                                    <i class="bi bi-clipboard-plus-fill"></i>
                                    <span>Keluhan / Catatan</span>
                                </div>
                                <div class="summary-value-full" id="summaryKeluhan">-</div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit" id="submitBtn" disabled>
                                <i class="bi bi-calendar-check-fill"></i>
                                <span>Buat Jadwal Temu Dokter</span>
                            </button>
                            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary btn-cancel">
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
        /* Info Card */
        .info-card {
            background: linear-gradient(135deg, rgba(0, 119, 182, 0.05), rgba(0, 150, 199, 0.05));
            border: 2px solid rgba(0, 119, 182, 0.15);
            border-radius: 15px;
            padding: 20px 25px;
            display: flex;
            align-items: start;
            gap: 20px;
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

        .info-card-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .info-card-content h6 {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .info-card-content p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
            line-height: 1.6;
        }

        /* Queue Info Card */
        .queue-info-card {
            background: linear-gradient(135deg, #f0f9ff, #e3f2fd);
            border: 2px solid #0077b6;
            border-radius: 15px;
            overflow: hidden;
        }

        .queue-info-header {
            background: linear-gradient(135deg, #0077b6, #0096c7);
            color: white;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .queue-info-icon {
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

        .queue-info-text h6 {
            margin: 0 0 3px 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .queue-info-text p {
            margin: 0;
            font-size: 0.85rem;
            opacity: 0.9;
        }

        .queue-number-display {
            padding: 25px;
            text-align: center;
        }

        .queue-number {
            font-size: 3.5rem;
            font-weight: 800;
            color: #0077b6;
            display: block;
            line-height: 1;
            margin-bottom: 10px;
            text-shadow: 0 4px 8px rgba(0, 119, 182, 0.3);
        }

        .queue-label {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 119, 182, 0.12);
            overflow: hidden;
            animation: slideUp 0.6s ease;
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
            background: linear-gradient(135deg, #0077b6, #0096c7);
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

        /* Form Sections */
        .form-section {
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f8fbff;
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .section-text h6 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin: 0 0 5px 0;
        }

        .section-text p {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin: 0;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 25px;
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
            border-color: #0077b6;
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 119, 182, 0.1);
        }

        .form-control::placeholder {
            color: #a0a0a0;
        }

        .input-icon {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #0077b6;
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
            background: #f0f9ff;
            border-left: 3px solid #0077b6;
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
            color: #0077b6;
            font-size: 1rem;
            margin-top: 2px;
        }

        /* Selected Items */
        .pet-info, .doctor-info {
            animation: slideDown 0.3s ease;
        }

        .pet-card, .doctor-card {
            background: #f0f9ff;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
        }

        .pet-icon, .doctor-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0077b6, #0096c7);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .pet-details h6, .doctor-details h6 {
            margin: 0 0 5px 0;
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
        }

        .pet-details p, .doctor-details p {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-gray);
        }

        .pet-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pet-badge {
            background: rgba(0, 119, 182, 0.1);
            color: #0077b6;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Summary Section */
        .summary-section {
            background: #f8fbff;
            border: 2px dashed #0077b6;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
        }

        .summary-header {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 20px;
        }

        .summary-header i {
            color: #06d6a0;
            font-size: 1.3rem;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .summary-item {
            background: white;
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #e8e8e8;
        }

        .summary-item-full {
            background: white;
            border-radius: 10px;
            padding: 15px;
            border: 2px solid #e8e8e8;
            grid-column: 1 / -1;
        }

        .summary-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-gray);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .summary-value {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
        }

        .summary-value:empty::before {
            content: "-";
            color: var(--text-gray);
            font-weight: 400;
        }

        .summary-value-full {
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            word-break: break-word;
            min-height: 60px;
            padding: 10px;
            background: #f8fbff;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
        }

        .summary-value-full:empty::before {
            content: "-";
            color: var(--text-gray);
            font-weight: 400;
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
            background: linear-gradient(135deg, #06d6a0, #05b589);
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
            box-shadow: 0 5px 20px rgba(6, 214, 160, 0.3);
            flex: 1;
            justify-content: center;
        }

        .btn-submit:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
        }

        .btn-submit:disabled {
            background: #e8e8e8;
            color: var(--text-gray);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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
            .info-card, .section-header {
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

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit, .btn-cancel {
                width: 100%;
            }

            .pet-meta {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('extra-js')
    <script>
        let selectedPemilik = null;
        let selectedPet = null;
        let selectedDoctor = null;

        document.addEventListener('DOMContentLoaded', function() {
            initializeEventListeners();
            updateSubmitButton();
            
            // Initialize keluhan summary
            updateKeluhanSummary();

            // Check if there are old values (for form validation errors)
            checkOldValues();
        });

        function initializeEventListeners() {
            // Select pemilik
            document.getElementById('idpemilik').addEventListener('change', handlePemilikSelection);

            // Select pet
            document.getElementById('idpet').addEventListener('change', handlePetSelection);

            // Select doctor
            document.getElementById('idrole_user').addEventListener('change', handleDoctorSelection);

            // Update keluhan summary when text changes
            document.getElementById('keluhan').addEventListener('input', updateKeluhanSummary);
        }

        function checkOldValues() {
            // Check if there are old values from form validation errors
            const oldIdPemilik = '{{ old("idpemilik") }}';
            const oldIdPet = '{{ old("idpet") }}';
            const oldIdRoleUser = '{{ old("idrole_user") }}';
            
            if (oldIdPemilik) {
                document.getElementById('idpemilik').value = oldIdPemilik;
                handlePemilikSelection();
                
                if (oldIdPet) {
                    // Wait for pets to load then set the value
                    setTimeout(() => {
                        document.getElementById('idpet').value = oldIdPet;
                        handlePetSelection();
                    }, 100);
                }
            }
            
            if (oldIdRoleUser) {
                document.getElementById('idrole_user').value = oldIdRoleUser;
                handleDoctorSelection();
            }
        }

        function handlePemilikSelection() {
            const pemilikSelect = document.getElementById('idpemilik');
            const selectedOption = pemilikSelect.options[pemilikSelect.selectedIndex];
            
            if (selectedOption.value) {
                selectedPemilik = {
                    id: selectedOption.value,
                    nama: selectedOption.textContent.split(' - ')[0],
                    email: selectedOption.textContent.split(' - ')[1]
                };
                
                // Load pets for selected pemilik
                loadPetsByOwner(selectedOption.value, selectedOption.dataset.pets);
            } else {
                selectedPemilik = null;
                resetPetSelection();
            }
            
            updateSummary();
            updateSubmitButton();
        }

        function loadPetsByOwner(idPemilik, petsData) {
            const petSelect = document.getElementById('idpet');
            
            try {
                const pets = JSON.parse(petsData);
                petSelect.innerHTML = '<option value="">Pilih hewan peliharaan...</option>';
                
                if (pets.length === 0) {
                    petSelect.innerHTML += '<option value="" disabled>Pemilik ini belum memiliki hewan terdaftar</option>';
                } else {
                    pets.forEach(pet => {
                        const option = document.createElement('option');
                        option.value = pet.idpet;
                        option.textContent = `${pet.nama} - ${pet.ras_hewan?.jenis_hewan?.nama_jenis_hewan || 'Unknown'} (${pet.ras_hewan?.nama_ras || 'Unknown'})`;
                        option.dataset.pet = JSON.stringify({
                            idpet: pet.idpet,
                            nama: pet.nama,
                            jenis_hewan: pet.ras_hewan?.jenis_hewan?.nama_jenis_hewan || 'Unknown',
                            ras: pet.ras_hewan?.nama_ras || 'Unknown',
                            jenis_kelamin: pet.jenis_kelamin,
                            tanggal_lahir: pet.tanggal_lahir
                        });
                        petSelect.appendChild(option);
                    });
                }
                
                petSelect.disabled = false;
            } catch (error) {
                console.error('Error parsing pets data:', error);
                petSelect.innerHTML = '<option value="">Error memuat data hewan</option>';
            }
        }

        function resetPetSelection() {
            const petSelect = document.getElementById('idpet');
            petSelect.innerHTML = '<option value="">Pilih hewan peliharaan...</option>';
            petSelect.disabled = true;
            document.getElementById('petInfo').style.display = 'none';
            selectedPet = null;
        }

        function handlePetSelection() {
            const petSelect = document.getElementById('idpet');
            const selectedOption = petSelect.options[petSelect.selectedIndex];
            
            if (selectedOption.value) {
                selectedPet = JSON.parse(selectedOption.dataset.pet);
                displayPetInfo(selectedPet);
            } else {
                selectedPet = null;
                document.getElementById('petInfo').style.display = 'none';
            }
            
            updateSummary();
            updateSubmitButton();
        }

        function displayPetInfo(pet) {
            document.getElementById('petNama').textContent = pet.nama;
            document.getElementById('petJenis').textContent = pet.jenis_hewan;
            document.getElementById('petRas').textContent = pet.ras;
            document.getElementById('petGender').textContent = pet.jenis_kelamin === 'J' ? 'Jantan' : 'Betina';
            
            // Calculate age
            if (pet.tanggal_lahir) {
                const age = calculateAge(pet.tanggal_lahir);
                document.getElementById('petAge').textContent = age;
            } else {
                document.getElementById('petAge').textContent = 'Usia tidak diketahui';
            }
            
            document.getElementById('petInfo').style.display = 'block';
        }

        function calculateAge(tanggalLahir) {
            const birthDate = new Date(tanggalLahir);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            return age + ' tahun';
        }

        function handleDoctorSelection() {
            const doctorSelect = document.getElementById('idrole_user');
            const selectedOption = doctorSelect.options[doctorSelect.selectedIndex];
            
            if (selectedOption.value) {
                selectedDoctor = {
                    id: selectedOption.value,
                    nama: selectedOption.textContent.split(' - ')[0],
                    email: selectedOption.textContent.split(' - ')[1]
                };
                displayDoctorInfo(selectedDoctor);
            } else {
                selectedDoctor = null;
                document.getElementById('doctorInfo').style.display = 'none';
            }
            
            updateSummary();
            updateSubmitButton();
        }

        function displayDoctorInfo(doctor) {
            document.getElementById('doctorNama').textContent = doctor.nama;
            document.getElementById('doctorEmail').textContent = doctor.email;
            document.getElementById('doctorInfo').style.display = 'block';
        }

        function updateSummary() {
            document.getElementById('summaryPemilik').textContent = selectedPemilik ? selectedPemilik.nama : '-';
            document.getElementById('summaryPet').textContent = selectedPet ? `${selectedPet.nama} - ${selectedPet.jenis_hewan}` : '-';
            document.getElementById('summaryDoctor').textContent = selectedDoctor ? selectedDoctor.nama : '-';
        }

        function updateKeluhanSummary() {
            const keluhan = document.getElementById('keluhan').value;
            const summaryKeluhan = document.getElementById('summaryKeluhan');
            
            if (keluhan.trim() === '') {
                summaryKeluhan.textContent = '-';
            } else {
                summaryKeluhan.textContent = keluhan;
            }
        }

        function updateSubmitButton() {
            const submitBtn = document.getElementById('submitBtn');
            const isFormValid = selectedPemilik && selectedPet && selectedDoctor;
            
            submitBtn.disabled = !isFormValid;
        }

        // Form validation before submit
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            if (!selectedPemilik || !selectedPet || !selectedDoctor) {
                e.preventDefault();
                showValidationError('Harap lengkapi semua data yang diperlukan!');
            }
        });

        function showValidationError(message) {
            // Create or show error notification
            const existingAlert = document.querySelector('.alert-danger');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-danger alert-dismissible fade show';
            alertDiv.innerHTML = `
                <div class="alert-content">
                    <div class="alert-icon">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                    </div>
                    <div class="alert-text">
                        <strong>Error!</strong>
                        <p>${message}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;

            document.querySelector('.content-wrapper').insertBefore(alertDiv, document.querySelector('.content-wrapper').firstChild);
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
@endsection