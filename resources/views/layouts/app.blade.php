<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Sistem Peminjaman Alat')</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
        <!-- Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            :root {
                --primary-color: #3b82f6;
                --secondary-color: #10b981;
                --danger-color: #ef4444;
                --warning-color: #f59e0b;
                --info-color: #06b6d4;
            }

            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                min-height: 100vh;
            }

            .navbar {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: white !important;
            }

            .sidebar {
                background: linear-gradient(180deg, #1e293b 0%, #334155 100%);
                color: #e2e8f0;
                min-height: calc(100vh - 60px);
                padding: 30px 0;
                box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            }

            .sidebar a {
                color: #cbd5e1;
                text-decoration: none;
                display: block;
                padding: 12px 25px;
                margin: 5px 0;
                border-radius: 5px;
                transition: all 0.3s ease;
            }

            .sidebar a:hover,
            .sidebar a.active {
                background-color: #667eea;
                color: #ffffff;
                padding-left: 35px;
            }

            .sidebar a i {
                margin-right: 10px;
                width: 20px;
            }

            .main-content {
                background: #f8fafc;
                min-height: calc(100vh - 60px);
                padding: 30px;
            }

            .card {
                border: none;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                border-radius: 10px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            }

            .card-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #ffffff;
                border: none;
                padding: 20px;
                border-radius: 10px 10px 0 0;
            }

            .btn-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                border: none;
                padding: 10px 25px;
                transition: all 0.3s ease;
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            }

            .btn-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                border: none;
                padding: 10px 25px;
            }

            .btn-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                border: none;
                padding: 10px 25px;
            }

            .btn-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                border: none;
                padding: 10px 25px;
                color: white;
            }

            .btn-sm {
                padding: 5px 12px;
                font-size: 0.875rem;
            }

            .table {
                background: white;
                border-radius: 10px;
                overflow: hidden;
            }

            .table thead {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: #ffffff;
            }

            .table tbody tr {
                border-bottom: 1px solid #e2e8f0;
                transition: background-color 0.2s ease;
            }

            .table tbody tr:hover {
                background-color: #f1f5f9;
            }

            .alert {
                border: none;
                border-radius: 10px;
                padding: 15px 20px;
            }

            .alert-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: #ffffff;
            }

            .alert-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: #ffffff;
            }

            .alert-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: #ffffff;
            }

            .alert-info {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: #ffffff;
            }

            .badge {
                padding: 8px 12px;
                border-radius: 20px;
                font-weight: 600;
            }

            .badge-primary {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
            }

            .badge-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
            }

            .badge-danger {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
            }

            .badge-warning {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
            }

            .badge-info {
                background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
                color: white;
            }

            .form-control, .form-select {
                border: 2px solid #e2e8f0;
                border-radius: 8px;
                padding: 10px 15px;
            }

            .form-control:focus, .form-select:focus {
                border-color: #667eea;
                box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            }

            .page-title {
                color: #ffffff;
                margin-bottom: 30px;
            }

            .page-title h1 {
                font-weight: 700;
                font-size: 2.5rem;
            }

            .page-title p {
                font-size: 1.1rem;
                opacity: 0.9;
            }

            .stats-card {
                background: white;
                border-radius: 10px;
                padding: 25px;
                text-align: center;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }

            .stats-card h3 {
                color: #667eea;
                font-weight: 700;
                font-size: 2rem;
            }

            .stats-card p {
                color: #64748b;
                margin-top: 10px;
            }

            .stats-card i {
                color: #667eea;
                font-size: 2.5rem;
                margin-bottom: 15px;
            }

            .form-section {
                background: white;
                padding: 30px;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .form-section h3 {
                color: #1e293b;
                margin-bottom: 20px;
                font-weight: 700;
            }

            .modal-content {
                border: none;
                border-radius: 10px;
            }

            .modal-header {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                border: none;
            }

            .modal-header .btn-close {
                filter: brightness(0) invert(1);
            }

            .modal-footer {
                background: #f8fafc;
                border: none;
            }

            .dropdown-menu {
                background: white;
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            }

            .dropdown-item {
                color: #1e293b;
                padding: 10px 20px;
                transition: all 0.2s ease;
            }

            .dropdown-item:hover {
                background: #f1f5f9;
                color: #667eea;
            }

            .dropdown-item i {
                margin-right: 8px;
                width: 18px;
            }

            .dropdown-divider {
                margin: 5px 0 !important;
                border-color: #e2e8f0;
            }

            .dropdown-item button {
                background: none;
                border: none;
                color: #1e293b;
                padding: 0;
                width: 100%;
                text-align: left;
                cursor: pointer;
            }

            .dropdown-item button:hover {
                color: #667eea;
            }

            .nav-link {
                color: white !important;
                transition: all 0.2s ease;
            }

            .nav-link:hover {
                color: #cbd5e1 !important;
            }

            @media (max-width: 768px) {
                .sidebar {
                    min-height: auto;
                    padding: 10px 0;
                }

                .sidebar a {
                    padding: 10px 15px;
                }

                .main-content {
                    padding: 15px;
                }

                .page-title h1 {
                    font-size: 1.8rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <i class="fas fa-tools"></i> Sistem Peminjaman Alat
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <button class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none; cursor: pointer;">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-cog"></i> Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                            @csrf
                                            <button type="submit" class="dropdown-item w-100 text-start">
                                                <i class="fas fa-sign-out-alt"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                    <!-- Sidebar -->
                    <div class="col-md-2 sidebar">
                        <a href="{{ route('dashboard') }}" class="@if(Route::currentRouteName() === 'dashboard') active @endif">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>

                        @if(Auth::user()->isAdmin())
                            <h6 class="mt-3 mb-2 ps-4" style="color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Admin</h6>
                            <a href="{{ route('users.index') }}" class="@if(Route::currentRouteName() === 'users.index') active @endif">
                                <i class="fas fa-users"></i> Kelola User
                            </a>
                            <a href="{{ route('kategoris.index') }}" class="@if(Route::currentRouteName() === 'kategoris.index') active @endif">
                                <i class="fas fa-tags"></i> Kategori Alat
                            </a>
                            <a href="{{ route('alats.index') }}" class="@if(Route::currentRouteName() === 'alats.index') active @endif">
                                <i class="fas fa-toolbox"></i> Kelola Alat
                            </a>
                            <a href="{{ route('reports.peminjaman') }}" target="_blank">
                                <i class="fas fa-file-pdf"></i> Laporan Peminjaman
                            </a>
                            <a href="{{ route('reports.pengembalian') }}" target="_blank">
                                <i class="fas fa-file-pdf"></i> Laporan Pengembalian
                            </a>
                            <a href="{{ route('reports.alat') }}" target="_blank">
                                <i class="fas fa-file-pdf"></i> Laporan Alat
                            </a>
                            <a href="{{ route('reports.user') }}" target="_blank">
                                <i class="fas fa-file-pdf"></i> Laporan User
                            </a>
                        @endif

                        @if(Auth::user()->isOperator() || Auth::user()->isAdmin())
                            <h6 class="mt-3 mb-2 ps-4" style="color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Operator</h6>
                            <a href="{{ route('peminjamans.index') }}" class="@if(Route::currentRouteName() === 'peminjamans.index') active @endif">
                                <i class="fas fa-list"></i> Data Peminjaman
                            </a>
                            <a href="{{ route('pengembalians.index') }}" class="@if(Route::currentRouteName() === 'pengembalians.index') active @endif">
                                <i class="fas fa-undo"></i> Data Pengembalian
                            </a>
                        @endif

                        @if(Auth::user()->isMember())
                            <h6 class="mt-3 mb-2 ps-4" style="color: #94a3b8; font-size: 0.85rem; font-weight: 700; text-transform: uppercase;">Member</h6>
                            <a href="{{ route('alats.list') }}" class="@if(Route::currentRouteName() === 'alats.list') active @endif">
                                <i class="fas fa-list"></i> Daftar Alat
                            </a>
                            <a href="{{ route('peminjamans.index') }}" class="@if(Route::currentRouteName() === 'peminjamans.index') active @endif">
                                <i class="fas fa-book"></i> Peminjaman Saya
                            </a>
                            <a href="{{ route('pengembalians.form') }}" class="@if(Route::currentRouteName() === 'pengembalians.form') active @endif">
                                <i class="fas fa-undo"></i> Pengembalian Barang
                            </a>
                        @endif

                        <!-- Bottom Menu Items -->
                        <hr style="border-color: #475569; margin: 20px 15px;">
                        <a href="{{ route('profile.edit') }}" class="@if(Route::currentRouteName() === 'profile.edit') active @endif">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                        <form method="POST" action="{{ route('logout') }}" id="logoutFormSidebar" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="document.getElementById('logoutFormSidebar').submit(); return false;" style="color: #ef4444;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-10 main-content">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-check-circle"></i> Success!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-circle"></i> Error!</strong> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('warning'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle"></i> Warning!</strong> {{ session('warning') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if (session('info'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-info-circle"></i> Info!</strong> {{ session('info') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                @else
                    <!-- Full Width for Non-Authenticated Users -->
                    <div class="col-md-12 main-content">
                        @yield('content')
                    </div>
                @endauth
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script>
            // Auto hide alerts after 5 seconds
            document.addEventListener('DOMContentLoaded', function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    setTimeout(function() {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, 5000);
                });
            });
        </script>
    </body>
</html>
