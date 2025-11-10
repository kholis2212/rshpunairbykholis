<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role User - RSHP UNAIR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #0077b6;
            --primary-dark: #023e8a;
            --secondary: #00b4d8;
            --accent: #ffc300;
            --success: #06d6a0;
            --danger: #ef476f;
            --warning: #ffa500;
            --light-bg: #f8fbff;
            --white: #ffffff;
            --text-dark: #1a1a2e;
            --text-gray: #4a5568;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0077b6 0%, #023e8a 100%);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 700px;
            width: 100%;
        }

        .form-card {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: slideUp 0.5s ease;
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

        .form-header {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            padding: 35px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .form-header-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-header p {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        .form-body {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .required {
            color: var(--danger);
            margin-left: 3px;
        }

        .error-message {
            color: var(--danger);
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error-message::before {
            content: "⚠️";
        }

        .form-actions {
            display: flex;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            flex: 1;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255, 165, 0, 0.4);
        }

        .btn-secondary {
            background: var(--light-bg);
            color: var(--text-dark);
            border: 2px solid #e8e8e8;
        }

        .btn-secondary:hover {
            background: #e8e8e8;
            transform: translateY(-2px);
        }

        .form-hint {
            background: #fff8e6;
            border-left: 4px solid var(--warning);
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            color: var(--text-gray);
            font-size: 0.9rem;
            display: flex;
            align-items: start;
            gap: 12px;
        }

        .form-hint::before {
            content: "⚠️";
            font-size: 1.3rem;
        }

        .current-value {
            background: #f0f9ff;
            border: 2px solid var(--primary);
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .current-value-label {
            font-size: 0.85rem;
            color: var(--text-gray);
            font-weight: 500;
            margin-bottom: 8px;
        }

        .current-value-text {
            font-size: 1.1rem;
            color: var(--primary-dark);
            font-weight: 700;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 15px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            background: var(--light-bg);
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkbox-item:hover {
            background: #e6f4ff;
            border-color: var(--primary);
        }

        .checkbox-item.checked {
            background: #e6f4ff;
            border-color: var(--primary);
        }

        .checkbox-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: var(--primary);
        }

        .checkbox-item input[type="checkbox"]:checked + label {
            color: var(--primary);
            font-weight: 600;
        }

        .checkbox-item label {
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-dark);
            margin: 0;
        }

        .role-section {
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            padding: 20px;
        }

        .role-section-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .role-section-title::before {
            content: "🔐";
            font-size: 1.2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .form-header {
                padding: 30px 25px;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-body {
                padding: 30px 25px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }

            .checkbox-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <!-- Header -->
            <div class="form-header">
                <div class="form-header-icon">✏️</div>
                <h1>Edit Role User</h1>
                <p>Perbarui hak akses user</p>
            </div>

            <!-- Body -->
            <div class="form-body">
                <div class="current-value">
                    <div class="current-value-label">👤 User:</div>
                    <div class="current-value-text">{{ $user->nama }} ({{ $user->email }})</div>
                </div>

                <div class="form-hint">
                    <span>Pastikan user memiliki minimal 1 role aktif</span>
                </div>

                <form action="{{ route('admin.role-user.update', $user->iduser) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <div class="role-section">
                            <div class="role-section-title">
                                Pilih Role (minimal 1)
                                <span class="required">*</span>
                            </div>
                            
                            <div class="checkbox-group">
                                @foreach($roles as $role)
                                <div class="checkbox-item {{ in_array($role->idrole, $userRoles) ? 'checked' : '' }}">
                                    <input type="checkbox" 
                                           id="role_{{ $role->idrole }}" 
                                           name="roles[]" 
                                           value="{{ $role->idrole }}"
                                           {{ in_array($role->idrole, old('roles', $userRoles)) ? 'checked' : '' }}
                                           onchange="updateCheckboxStyle(this)">
                                    <label for="role_{{ $role->idrole }}">{{ $role->nama_role }}</label>
                                </div>
                                @endforeach
                            </div>
                            
                            @error('roles')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning">
                            <span>💾</span>
                            <span>Update Role</span>
                        </button>
                        <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary">
                            <span>↩️</span>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Update checkbox item style
        function updateCheckboxStyle(checkbox) {
            const item = checkbox.closest('.checkbox-item');
            if (checkbox.checked) {
                item.classList.add('checked');
            } else {
                item.classList.remove('checked');
            }
        }

        // Form validation before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const roles = document.querySelectorAll('input[name="roles[]"]:checked');
            
            if (roles.length === 0) {
                e.preventDefault();
                alert('⚠️ Pilih minimal 1 role untuk user!');
            }
        });
    </script>
</body>
</html>