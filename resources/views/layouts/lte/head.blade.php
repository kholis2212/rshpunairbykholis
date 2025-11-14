<!doctype html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Admin - RSHP UNAIR')</title>
    
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#0077b6" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="@yield('title', 'Admin - RSHP UNAIR')" />
    <meta name="author" content="Kholis Abdi" />
    <meta name="description" content="Sistem Manajemen Rumah Sakit Hewan Pendidikan Universitas Airlangga" />
    <!--end::Primary Meta Tags-->
    
    <!--begin::Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    
    <!-- Custom Styles -->
    <style>
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Segoe UI Emoji', 'Noto Color Emoji', 'Apple Color Emoji', sans-serif !important;
            background: var(--light-bg) !important;
            overflow-x: hidden;
        }
        
        /* Animated Background for Main Content Area */
        .app-main::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(0, 180, 216, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 195, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }
        
        /* Brand Link */
        .brand-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            border-bottom: 3px solid var(--accent) !important;
            padding: 20px 20px !important;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.2);
        }
        
        .brand-link:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary)) !important;
            transform: translateX(5px);
        }
        
        .brand-image {
            transition: transform 0.3s ease;
            filter: drop-shadow(0 2px 5px rgba(0,0,0,0.2));
        }
        
        .brand-link:hover .brand-image {
            transform: scale(1.1) rotate(-5deg);
        }
        
        .brand-text {
            font-weight: 800 !important;
            font-size: 1.15rem !important;
            letter-spacing: 0.5px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Sidebar */
        .app-sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%) !important;
            box-shadow: 4px 0 20px rgba(0,0,0,0.15);
            position: relative;
            overflow: hidden;
        }
        
        .app-sidebar::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 30%, rgba(0, 119, 182, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255, 195, 0, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .nav-header {
            color: var(--accent) !important;
            font-weight: 800 !important;
            font-size: 0.75rem !important;
            padding: 15px 15px 10px !important;
            margin-top: 15px !important;
            letter-spacing: 1px;
            text-transform: uppercase;
            position: relative;
        }
        
        .nav-header::before {
            content: "";
            position: absolute;
            left: 15px;
            bottom: 5px;
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, var(--accent), transparent);
        }
        
        .nav-sidebar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            padding: 14px 15px !important;
            margin: 5px 12px !important;
            border-radius: 10px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative;
            overflow: hidden;
        }
        
        .nav-sidebar .nav-link::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--secondary));
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .nav-sidebar .nav-link:hover {
            background: rgba(0, 119, 182, 0.2) !important;
            color: white !important;
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.2);
        }
        
        .nav-sidebar .nav-link:hover::before {
            transform: scaleY(1);
        }
        
        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.4) !important;
            font-weight: 700 !important;
            transform: translateX(5px);
        }
        
        .nav-sidebar .nav-link.active::before {
            transform: scaleY(1);
        }
        
        .nav-icon {
            margin-right: 12px !important;
            font-size: 1.2rem !important;
            transition: all 0.3s ease;
        }
        
        .nav-sidebar .nav-link:hover .nav-icon,
        .nav-sidebar .nav-link.active .nav-icon {
            transform: scale(1.2) rotate(5deg);
        }
        
        /* Header/Navbar */
        .app-header {
            background: var(--white) !important;
            border-bottom: 3px solid var(--accent) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .app-header .nav-link {
            color: var(--primary) !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
            padding: 10px 15px !important;
            border-radius: 8px;
        }
        
        .app-header .nav-link:hover {
            color: var(--primary-dark) !important;
            background: rgba(0, 119, 182, 0.1);
            transform: translateY(-2px);
        }
        
        /* Content Header */
        .app-content-header {
            padding: 30px 0 20px !important;
            background: var(--white);
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            position: relative;
            overflow: hidden;
        }
        
        .app-content-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }
        
        .app-content-header h3 {
            color: var(--primary-dark) !important;
            font-weight: 900 !important;
            font-size: 2rem !important;
            margin-bottom: 0 !important;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .breadcrumb {
            background: transparent !important;
            margin-bottom: 0 !important;
            padding: 0 !important;
        }
        
        .breadcrumb-item {
            font-weight: 500;
        }
        
        .breadcrumb-item a {
            color: var(--primary) !important;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--primary-dark) !important;
            transform: translateX(2px);
        }
        
        .breadcrumb-item.active {
            color: var(--text-gray) !important;
        }
        
        /* Cards */
        .card {
            box-shadow: 0 8px 30px rgba(0,0,0,0.08) !important;
            border: none !important;
            border-radius: 20px !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.12) !important;
            transform: translateY(-5px);
        }
        
        .card:hover::before {
            opacity: 1;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            border-radius: 20px 20px 0 0 !important;
            padding: 25px 30px !important;
            border: none !important;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::after {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
            animation: headerShine 8s ease-in-out infinite;
        }
        
        @keyframes headerShine {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-30%, -30%); }
        }
        
        .card-title {
            font-weight: 800 !important;
            font-size: 1.3rem !important;
            margin: 0 !important;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .card-body {
            padding: 30px !important;
            position: relative;
        }
        
        /* Buttons */
        .btn {
            border-radius: 10px !important;
            padding: 12px 25px !important;
            font-weight: 700 !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: none !important;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.5s ease, height 0.5s ease;
        }
        
        .btn:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.3) !important;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary), var(--primary)) !important;
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(0, 119, 182, 0.4) !important;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success), #05b589) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(6, 214, 160, 0.3) !important;
        }
        
        .btn-success:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(6, 214, 160, 0.4) !important;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(255, 165, 0, 0.3) !important;
        }
        
        .btn-warning:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(255, 165, 0, 0.4) !important;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #d62839) !important;
            color: white !important;
            box-shadow: 0 6px 20px rgba(239, 71, 111, 0.3) !important;
        }
        
        .btn-danger:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(239, 71, 111, 0.4) !important;
        }
        
        /* Small Box */
        .small-box {
            border-radius: 20px !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            border: 3px solid transparent !important;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
            position: relative;
            overflow: hidden;
        }
        
        .small-box::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            animation: boxShine 6s ease-in-out infinite;
        }
        
        @keyframes boxShine {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(-20%, -20%); }
        }
        
        .small-box:hover {
            transform: translateY(-10px) scale(1.02) !important;
            box-shadow: 0 15px 50px rgba(0,0,0,0.2) !important;
            border-color: var(--accent) !important;
        }
        
        .small-box-icon {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
        }
        
        .small-box:hover .small-box-icon {
            transform: scale(1.15) rotate(10deg) translateY(-10px) !important;
        }
        
        .small-box .inner {
            position: relative;
            z-index: 1;
        }
        
        .small-box-footer {
            font-weight: 700 !important;
            padding: 15px 0 !important;
            transition: all 0.3s ease !important;
            position: relative;
            z-index: 1;
        }
        
        .small-box:hover .small-box-footer {
            background: rgba(0,0,0,0.15) !important;
            letter-spacing: 0.5px;
        }
        
        /* Alerts */
        .alert {
            border-radius: 15px !important;
            border: none !important;
            padding: 20px 25px !important;
            font-weight: 600 !important;
            box-shadow: 0 6px 20px rgba(0,0,0,0.12) !important;
            position: relative;
            overflow: hidden;
        }
        
        .alert::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 100%;
            background: rgba(255,255,255,0.5);
        }
        
        .alert-success {
            background: linear-gradient(135deg, var(--success), #05b589) !important;
            color: white !important;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, var(--danger), #d62839) !important;
            color: white !important;
        }
        
        .alert-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00) !important;
            color: white !important;
        }
        
        /* Tables */
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            font-weight: 700 !important;
            border: none !important;
            padding: 18px 15px !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(0, 119, 182, 0.05), transparent) !important;
            transform: scale(1.01);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .table tbody td {
            padding: 15px !important;
            vertical-align: middle;
        }
        
        /* Badges */
        .badge {
            padding: 8px 15px !important;
            border-radius: 8px !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px;
        }
        
        .text-bg-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
        }
        
        .text-bg-warning {
            background: linear-gradient(135deg, var(--accent), #ffdb4d) !important;
            color: var(--primary-dark) !important;
        }
        
        /* User Menu */
        .user-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            padding: 30px !important;
            position: relative;
            overflow: hidden;
        }
        
        .user-header::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            border: none !important;
            border-radius: 8px !important;
        }
        
        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 2px solid var(--primary) !important;
            border-radius: 8px !important;
            padding: 8px 15px !important;
            transition: all 0.3s ease;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--secondary) !important;
            box-shadow: 0 0 0 3px rgba(0, 119, 182, 0.1) !important;
            outline: none;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--light-bg);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }
        
        /* Dropdown Menu */
        .dropdown-menu {
            border: none !important;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15) !important;
            border-radius: 15px !important;
            overflow: hidden;
        }
        
        .dropdown-item {
            padding: 12px 20px !important;
            transition: all 0.3s ease;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(90deg, rgba(0, 119, 182, 0.1), transparent) !important;
            color: var(--primary) !important;
            transform: translateX(5px);
        }
        
        /* Loading Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .app-content-header h3 {
                font-size: 1.5rem !important;
            }
            
            .card-body {
                padding: 20px !important;
            }
            
            .small-box .inner {
                padding: 20px !important;
            }
        }
    </style>
    
    @yield('extra-css')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">