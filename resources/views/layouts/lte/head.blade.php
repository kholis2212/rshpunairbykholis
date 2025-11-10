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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" 
          crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" 
          crossorigin="anonymous" />
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
        
        body {
            font-family: 'Poppins', sans-serif !important;
            background: var(--light-bg) !important;
        }
        
        /* Brand Link */
        .brand-link {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            border-bottom: 3px solid var(--accent) !important;
            padding: 18px 20px !important;
            transition: all 0.3s ease;
        }
        
        .brand-link:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary)) !important;
        }
        
        .brand-image {
            transition: transform 0.3s ease;
        }
        
        .brand-link:hover .brand-image {
            transform: scale(1.05);
        }
        
        .brand-text {
            font-weight: 700 !important;
            font-size: 1.1rem !important;
        }
        
        /* Sidebar */
        .app-sidebar {
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%) !important;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }
        
        .nav-header {
            color: var(--accent) !important;
            font-weight: 700 !important;
            font-size: 0.75rem !important;
            padding: 12px 15px 8px !important;
            margin-top: 10px !important;
        }
        
        .nav-sidebar .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 12px 15px !important;
            margin: 4px 10px !important;
            border-radius: 8px !important;
            transition: all 0.3s ease !important;
        }
        
        .nav-sidebar .nav-link:hover {
            background: rgba(0, 119, 182, 0.15) !important;
            color: white !important;
            transform: translateX(5px);
        }
        
        .nav-sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.3) !important;
            font-weight: 600 !important;
        }
        
        .nav-icon {
            margin-right: 10px !important;
            font-size: 1.1rem !important;
        }
        
        /* Header/Navbar */
        .app-header {
            background: var(--white) !important;
            border-bottom: 3px solid var(--accent) !important;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08) !important;
        }
        
        .app-header .nav-link {
            color: var(--primary) !important;
            font-weight: 600 !important;
            transition: all 0.3s ease;
        }
        
        .app-header .nav-link:hover {
            color: var(--primary-dark) !important;
            transform: translateY(-2px);
        }
        
        /* Content Header */
        .app-content-header {
            padding: 25px 0 15px !important;
            background: var(--white);
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .app-content-header h3 {
            color: var(--primary-dark) !important;
            font-weight: 800 !important;
            font-size: 1.8rem !important;
        }
        
        .breadcrumb {
            background: transparent !important;
            margin-bottom: 0 !important;
        }
        
        .breadcrumb-item a {
            color: var(--primary) !important;
            text-decoration: none;
            font-weight: 600;
        }
        
        .breadcrumb-item.active {
            color: var(--text-gray) !important;
        }
        
        /* Cards */
        .card {
            box-shadow: 0 5px 25px rgba(0,0,0,0.08) !important;
            border: none !important;
            border-radius: 15px !important;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 8px 35px rgba(0,0,0,0.12) !important;
            transform: translateY(-3px);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px 25px !important;
            border: none !important;
        }
        
        .card-title {
            font-weight: 700 !important;
            font-size: 1.2rem !important;
            margin: 0 !important;
        }
        
        .card-body {
            padding: 25px !important;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px !important;
            padding: 10px 20px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            border: none !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(0, 119, 182, 0.3) !important;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary), var(--primary)) !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(0, 119, 182, 0.4) !important;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success), #05b589) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(6, 214, 160, 0.3) !important;
        }
        
        .btn-success:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(6, 214, 160, 0.4) !important;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning), #ff8c00) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(255, 165, 0, 0.3) !important;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(255, 165, 0, 0.4) !important;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #d62839) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3) !important;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(239, 71, 111, 0.4) !important;
        }
        
        /* Small Box */
        .small-box {
            border-radius: 15px !important;
            transition: all 0.4s ease !important;
            border: 2px solid transparent !important;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
        }
        
        .small-box:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 12px 40px rgba(0,0,0,0.15) !important;
            border-color: var(--accent) !important;
        }
        
        .small-box-icon {
            transition: all 0.4s ease !important;
        }
        
        .small-box:hover .small-box-icon {
            transform: scale(1.1) rotate(5deg) !important;
        }
        
        .small-box-footer {
            font-weight: 600 !important;
            padding: 12px 0 !important;
            transition: all 0.3s ease !important;
        }
        
        .small-box:hover .small-box-footer {
            background: rgba(0,0,0,0.1) !important;
        }
        
        /* Alerts */
        .alert {
            border-radius: 10px !important;
            border: none !important;
            padding: 15px 20px !important;
            font-weight: 500 !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
        }
        
        .alert-success {
            background: linear-gradient(135deg, var(--success), #05b589) !important;
            color: white !important;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, var(--danger), #d62839) !important;
            color: white !important;
        }
        
        /* Tables */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table thead th {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            color: white !important;
            font-weight: 600 !important;
            border: none !important;
            padding: 15px !important;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: var(--light-bg) !important;
            transform: scale(1.01);
        }
        
        /* Badges */
        .badge {
            padding: 6px 12px !important;
            border-radius: 6px !important;
            font-weight: 600 !important;
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
            padding: 25px !important;
        }
        
        /* DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: white !important;
            border: none !important;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--light-bg);
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }
    </style>
    
    @yield('extra-css')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<!--begin::App Wrapper-->
<div class="app-wrapper">