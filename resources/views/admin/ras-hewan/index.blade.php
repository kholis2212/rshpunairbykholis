<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ras Hewan - RSHP UNAIR</title>
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header Card */
        .header-card {
            background: var(--white);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .header-title h1 {
            color: var(--primary-dark);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .header-title p {
            color: var(--text-gray);
            font-size: 0.95rem;
            margin-top: 5px;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        /* Buttons */
        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            box-shadow: 0 5px 20px rgba(0, 119, 182, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success), #05b589);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(6, 214, 160, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(255, 165, 0, 0.3);
        }

        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #d62839);
            color: var(--white);
            box-shadow: 0 5px 20px rgba(239, 71, 111, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(239, 71, 111, 0.4);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85rem;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideDown 0.4s ease;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
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

        .alert-success {
            background: linear-gradient(135deg, #06d6a0, #05b589);
            color: var(--white);
        }

        .alert-success::before {
            content: "✓";
            font-size: 1.5rem;
            font-weight: bold;
        }

        .alert-error {
            background: linear-gradient(135deg, #ef476f, #d62839);
            color: var(--white);
        }

        .alert-error::before {
            content: "✗";
            font-size: 1.5rem;
            font-weight: bold;
        }

        /* Table Card */
        .table-card {
            background: var(--white);
            border-radius: 20px;
            padding: 0;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .table-header h2 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding: 10px 40px 10px 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            font-size: 0.9rem;
            width: 250px;
            transition: all 0.3s ease;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .search-box input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .table-wrapper {
            overflow-x: auto;
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--light-bg);
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.95rem;
            border-bottom: 2px solid var(--primary);
        }

        td {
            padding: 18px 15px;
            border-bottom: 1px solid #e8e8e8;
            color: var(--text-dark);
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: #f0f9ff;
            transform: scale(1.01);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-number {
            background: linear-gradient(135deg, var(--accent), #ffdb4d);
            color: var(--primary-dark);
        }

        .badge-category {
            background: linear-gradient(135deg, var(--secondary), #48cae4);
            color: var(--white);
            padding: 8px 15px;
            font-size: 0.85rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--text-gray);
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        /* Modal Confirm Delete */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: var(--white);
            margin: 10% auto;
            padding: 40px;
            border-radius: 20px;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            text-align: center;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--danger), #d62839);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 25px;
            animation: pulse 1.5s ease infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .modal-content h3 {
            color: var(--text-dark);
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .modal-content p {
            color: var(--text-gray);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .modal-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .header-card {
                padding: 20px;
                text-align: center;
                flex-direction: column;
            }

            .header-title h1 {
                font-size: 1.4rem;
            }

            .search-box input {
                width: 100%;
            }

            .table-wrapper {
                padding: 20px 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .modal-content {
                margin: 20% 15px;
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header-card">
            <div class="header-title">
                <div class="header-icon">🐕</div>
                <div>
                    <h1>Data Ras Hewan</h1>
                    <p>Kelola data ras hewan untuk sistem RSHP</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.dashboard-admin') }}" class="btn btn-primary">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-success">
                    <span>➕</span>
                    <span>Tambah Data</span>
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Alert Error -->
        @if(session('error'))
            <div class="alert alert-error">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h2>📋 Daftar Ras Hewan</h2>
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="🔍 Cari ras hewan..." onkeyup="searchTable()">
                </div>
            </div>

            <div class="table-wrapper">
                @if($rasHewan->count() > 0)
                    <table id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 80px;">No</th>
                                <th>Nama Ras</th>
                                <th>Jenis Hewan</th>
                                <th style="width: 200px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rasHewan as $index => $item)
                            <tr>
                                <td>
                                    <span class="badge badge-number">{{ $index + 1 }}</span>
                                </td>
                                <td style="font-weight: 500;">{{ $item->nama_ras }}</td>
                                <td>
                                    <span class="badge badge-category">{{ $item->jenisHewan->nama_jenis_hewan }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="{{ route('admin.ras-hewan.edit', $item->idras_hewan) }}" class="btn btn-warning btn-sm">
                                            <span>✏️</span>
                                            <span>Edit</span>
                                        </a>
                                        <button onclick="confirmDelete({{ $item->idras_hewan }}, '{{ $item->nama_ras }}')" class="btn btn-danger btn-sm">
                                            <span>🗑️</span>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h3>Belum Ada Data</h3>
                        <p>Silakan tambahkan data ras hewan terlebih dahulu</p>
                        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-success" style="margin-top: 20px;">
                            <span>➕</span>
                            <span>Tambah Data Pertama</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-icon">⚠️</div>
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus ras hewan <strong id="deleteItemName"></strong>?</p>
            <p style="color: var(--danger); font-size: 0.9rem;">Data yang dihapus tidak dapat dikembalikan!</p>
            
            <form id="deleteForm" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <div class="modal-buttons">
                    <button type="button" onclick="closeModal()" class="btn btn-primary">
                        <span>✖️</span>
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <span>🗑️</span>
                        <span>Ya, Hapus!</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Search Function
        function searchTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.getElementById('dataTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const tdRas = tr[i].getElementsByTagName('td')[1];
                const tdJenis = tr[i].getElementsByTagName('td')[2];
                
                if (tdRas || tdJenis) {
                    const txtRas = tdRas ? (tdRas.textContent || tdRas.innerText) : '';
                    const txtJenis = tdJenis ? (tdJenis.textContent || tdJenis.innerText) : '';
                    
                    if (txtRas.toLowerCase().indexOf(filter) > -1 || txtJenis.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        // Modal Functions
        function confirmDelete(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const itemName = document.getElementById('deleteItemName');
            
            form.action = `/admin/ras-hewan/${id}`;
            itemName.textContent = name;
            modal.style.display = 'block';
        }

        function closeModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Auto hide alert after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.animation = 'slideDown 0.4s ease reverse';
                setTimeout(() => alert.remove(), 400);
            });
        }, 5000);
    </script>
</body>
</html>