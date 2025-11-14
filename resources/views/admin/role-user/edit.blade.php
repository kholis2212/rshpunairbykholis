{{-- views/admin/role-user/edit.blade.php --}}
@extends('layouts.lte.main')

@section('title', 'Edit Role User - RSHP UNAIR')

@section('page-icon', 'person-gear')
@section('page-title', 'Edit Role User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard-admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role-user.index') }}">Manajemen Role User</a></li>
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
                        <h6>User Saat Ini</h6>
                        <p>Data user yang akan diperbarui role-nya</p>
                    </div>
                </div>
                <div class="current-value-body">
                    <div class="current-value-label">
                        <i class="bi bi-person-fill"></i>
                        <span>Nama User</span>
                    </div>
                    <div class="current-value-display">
                        {{ $user->nama }}
                    </div>
                    <div class="current-value-label mt-3">
                        <i class="bi bi-envelope-fill"></i>
                        <span>Email</span>
                    </div>
                    <div class="current-value-display">
                        {{ $user->email }}
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
                    <p>Pastikan user memiliki minimal 1 role aktif. Perubahan role akan mempengaruhi hak akses user ke sistem</p>
                </div>
            </div>

            <!-- Form Card -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="card-header-icon">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div class="card-header-text">
                        <h5>Form Edit Role User</h5>
                        <p>Perbarui role user dengan informasi yang benar</p>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.role-user.update', $user->iduser) }}" method="POST" id="formEdit">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-shield-check me-2"></i>
                                Pilih Role Baru
                                <span class="required">*</span>
                            </label>
                            <div class="role-section">
                                <div class="role-grid" id="roleGrid">
                                    @foreach($roles as $role)
                                    <div class="role-item" data-role-id="{{ $role->idrole }}">
                                        <input type="checkbox" 
                                               id="role_{{ $role->idrole }}" 
                                               name="roles[]" 
                                               value="{{ $role->idrole }}"
                                               {{ in_array($role->idrole, old('roles', $userRoles)) ? 'checked' : '' }}
                                               class="role-checkbox"
                                               onchange="updateRolePreview(this)">
                                        <label for="role_{{ $role->idrole }}" class="role-label">
                                            <div class="role-icon">
                                                <i class="bi bi-shield-check"></i>
                                            </div>
                                            <div class="role-text">
                                                <span class="role-name">{{ $role->nama_role }}</span>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @error('roles')
                                <div class="invalid-feedback d-flex align-items-center gap-2" style="display: block !important;">
                                    <i class="bi bi-exclamation-circle-fill"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle-fill"></i>
                                <span>Pilih minimal 1 role untuk user. Role yang dipilih akan menggantikan role sebelumnya</span>
                            </div>
                        </div>

                        <div class="comparison-section">
                            <div class="comparison-header">
                                <i class="bi bi-arrow-left-right"></i>
                                <span>Perbandingan Role</span>
                            </div>
                            <div class="comparison-grid">
                                <div class="comparison-item comparison-old">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-text"></i>
                                        <span>Role Lama</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Role yang Dimiliki:</span>
                                            <div class="field-value">
                                                @if(count($userRoles) > 0)
                                                    @foreach($roles as $role)
                                                        @if(in_array($role->idrole, $userRoles))
                                                            <span class="badge-role badge-{{ strtolower(str_replace(' ', '', $role->nama_role)) }} me-1 mb-1">
                                                                {{ $role->nama_role }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Belum ada role</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="comparison-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                                <div class="comparison-item comparison-new">
                                    <div class="comparison-label">
                                        <i class="bi bi-file-earmark-check"></i>
                                        <span>Role Baru</span>
                                    </div>
                                    <div class="comparison-content">
                                        <div class="comparison-field">
                                            <span class="field-label">Role yang Akan Dimiliki:</span>
                                            <div class="field-value" id="newRolesPreview">
                                                @php
                                                    $selectedRoles = old('roles', $userRoles);
                                                @endphp
                                                @if(count($selectedRoles) > 0)
                                                    @foreach($roles as $role)
                                                        @if(in_array($role->idrole, $selectedRoles))
                                                            <span class="badge-role badge-{{ strtolower(str_replace(' ', '', $role->nama_role)) }} me-1 mb-1">
                                                                {{ $role->nama_role }}
                                                            </span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">Belum ada role</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-submit">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Update Role</span>
                            </button>
                            <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary btn-cancel">
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
            margin-bottom: 8px;
        }

        .current-value-label i {
            color: #0077b6;
            font-size: 1rem;
        }

        .current-value-display {
            background: white;
            border: 2px solid #0077b6;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 1rem;
            font-weight: 700;
            color: #023e8a;
            margin-bottom: 15px;
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

        /* Role Section */
        .role-section {
            background: #f8fbff;
            border: 2px solid #e8e8e8;
            border-radius: 15px;
            padding: 25px;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .role-item {
            position: relative;
        }

        .role-checkbox {
            display: none;
        }

        .role-label {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            background: white;
            border: 2px solid #e8e8e8;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .role-label:hover {
            border-color: #ffa500;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.1);
        }

        .role-checkbox:checked + .role-label {
            background: linear-gradient(135deg, #ffa500, #ff8c00);
            border-color: #ffa500;
            color: white;
        }

        .role-checkbox:checked + .role-label .role-icon {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .role-icon {
            width: 45px;
            height: 45px;
            background: #f8fbff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #ffa500;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .role-text {
            flex: 1;
        }

        .role-name {
            font-weight: 600;
            font-size: 0.95rem;
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
            gap: 12px;
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

        /* Form Card */
        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(255, 165, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.7s ease;
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

        .invalid-feedback {
            color: #ef476f;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 8px;
            display: flex !important;
            animation: shake 0.4s ease;
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

            .role-grid {
                grid-template-columns: 1fr;
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
        const allRoles = @json($roles);

        // Update role preview
        function updateRolePreview(checkbox) {
            const selectedRoles = Array.from(document.querySelectorAll('.role-checkbox:checked'))
                .map(cb => cb.value);
            
            const previewContainer = document.getElementById('newRolesPreview');
            
            if (selectedRoles.length > 0) {
                const roleBadges = selectedRoles.map(roleId => {
                    const role = allRoles.find(r => r.idrole == roleId);
                    if (role) {
                        return `<span class="badge-role badge-${role.nama_role.toLowerCase().replace(' ', '')} me-1 mb-1">${role.nama_role}</span>`;
                    }
                    return '';
                }).filter(Boolean).join('');
                
                previewContainer.innerHTML = roleBadges;
            } else {
                previewContainer.innerHTML = '<span class="text-muted">Belum ada role</span>';
            }
        }

        // Form validation before submit
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            const roles = document.querySelectorAll('input[name="roles[]"]:checked');
            
            if (roles.length === 0) {
                e.preventDefault();
                const roleSection = document.querySelector('.role-section');
                if (!roleSection.querySelector('.invalid-feedback')) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-flex align-items-center gap-2';
                    errorDiv.style.display = 'block !important';
                    errorDiv.innerHTML = '<i class="bi bi-exclamation-circle-fill"></i><span>Pilih minimal 1 role!</span>';
                    roleSection.appendChild(errorDiv);
                }
            }
        });

        // Remove error on role selection
        document.querySelectorAll('.role-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const roleSection = document.querySelector('.role-section');
                const existingError = roleSection.querySelector('.invalid-feedback');
                if (existingError) {
                    existingError.remove();
                }
            });
        });

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateRolePreview();
        });
    </script>
@endsection