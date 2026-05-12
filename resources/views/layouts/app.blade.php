{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Eduspace') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #64748b;
            --accent: #f472b6;
            --sidebar-width: 280px;
            --sidebar-bg: #ffffff;
            --sidebar-text: #64748b;
            --sidebar-active: #6366f1;
            --sidebar-hover: #f8fafc;
            --content-bg: #f1f5f9;
            --card-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.05), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --card-shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
        }

        html {
            scroll-behavior: smooth;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--content-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            height: 100vh;
            position: fixed;
            left: 0; top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-header { padding: 2rem 1.5rem; display: flex; align-items: center; gap: 12px; }
        .sidebar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #0f172a; }
        .brand-logo {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);
        }
        .brand-logo i { font-size: 1.2rem; color: white; }
        .brand-text { font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 800; letter-spacing: -0.5px; }

        .sidebar-user {
            margin: 0 1rem 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            display: flex; align-items: center; gap: 12px;
        }
        .user-avatar {
            width: 44px; height: 44px;
            background: var(--primary);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700;
        }
        .user-name { font-size: 0.9rem; font-weight: 700; color: #0f172a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 0.75rem; color: var(--sidebar-text); }

        .sidebar-nav { flex: 1; padding: 0 1rem; overflow-y: auto; }
        .nav-section-title {
            font-size: 0.7rem; font-weight: 800; color: #475569;
            text-transform: uppercase; letter-spacing: 1px;
            margin: 1.5rem 0 0.5rem 0.75rem;
        }
        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 0.875rem 1rem; color: var(--sidebar-text);
            text-decoration: none; border-radius: 12px;
            font-size: 0.9rem; font-weight: 600;
            transition: all 0.2s ease; margin-bottom: 4px;
        }
        .nav-link i { width: 20px; font-size: 1.1rem; text-align: center; }
        .nav-link:hover { background: var(--sidebar-hover); color: white; }
        .nav-link.active { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25); }

        .sidebar-footer { padding: 1.5rem; border-top: 1px solid #e2e8f0; }
        .logout-btn {
            width: 100%; padding: 0.75rem;
            background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171; border-radius: 12px;
            font-size: 0.9rem; font-weight: 700;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            cursor: pointer; transition: all 0.2s ease;
        }
        .logout-btn:hover { background: #ef4444; color: white; }

        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; transition: all 0.3s ease; }
        .content-wrapper { padding: 2rem; max-width: 1400px; margin: 0 auto; width: 100%; }

        /* Mobile Header */
        .mobile-header {
            display: none; background: white; padding: 1rem;
            border-bottom: 1px solid #e2e8f0; position: sticky; top: 0; z-index: 999;
            justify-content: space-between; align-items: center;
        }
        .navbar-toggler { border: none; font-size: 1.5rem; color: var(--sidebar-bg); background: none; }

        .sidebar-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 999;
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .sidebar-overlay.show { opacity: 1; visibility: visible; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--content-bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
            border: 2px solid var(--content-bg);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Sidebar Scrollbar */
        .sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
            border: none;
        }

        .sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
            .mobile-header { display: flex; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-brand">
                    <div class="brand-logo">
                        <img src="https://i.ibb.co.com/4gXC7wj0/1630622969900.jpg" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <span class="brand-text">SMKN 1 CIOMAS</span>
                </a>
            </div>

            <div class="sidebar-user">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main Menu</div>
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                @if(in_array(auth()->user()->role, ['admin', 'guru']))
                <div class="nav-section">
                    <div class="nav-section-title">Master Data</div>
                    <a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                        <i class="fas fa-user-graduate"></i>
                        <span>Data Siswa</span>
                    </a>
                    <a href="{{ route('guru.index') }}" class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Data Guru</span>
                    </a>
                </div>
                @endif

                @if(auth()->user()->role != 'kepsek')
                <div class="nav-section">
                    <div class="nav-section-title">Activities</div>
                    <a href="{{ route('pelanggaran.index') }}" class="nav-link {{ request()->routeIs('pelanggaran.*') ? 'active' : '' }}">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Pelanggaran</span>
                    </a>
                    <a href="{{ route('izin-keluar.index') }}" class="nav-link {{ request()->routeIs('izin-keluar.*') ? 'active' : '' }}">
                        <i class="fas fa-door-open"></i>
                        <span>Izin Keluar</span>
                    </a>
                    <a href="{{ route('keterlambatan.index') }}" class="nav-link {{ request()->routeIs('keterlambatan.*') ? 'active' : '' }}">
                        <i class="fas fa-clock"></i>
                        <span>Keterlambatan</span>
                    </a>
                </div>
                @endif

                @if(auth()->user()->role != 'kepsek')
                <div class="nav-section">
                    <div class="nav-section-title">Tools</div>
                    <a href="#" onclick="openQRScanner()" class="nav-link">
                        <i class="fas fa-qrcode"></i>
                        <span>QR Scanner</span>
                    </a>
                </div>
                @endif

                <div class="nav-section">
                    <div class="nav-section-title">Reports</div>
                    <a href="{{ route('laporan.izin') }}" class="nav-link {{ request()->routeIs('laporan.izin') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i>
                        <span>Laporan Izin</span>
                    </a>
                    <a href="{{ route('laporan.keterlambatan') }}" class="nav-link {{ request()->routeIs('laporan.keterlambatan') ? 'active' : '' }}">
                        <i class="fas fa-file-invoice"></i>
                        <span>Laporan Terlambat</span>
                    </a>
                    <a href="{{ route('laporan.pelanggaran') }}" class="nav-link {{ request()->routeIs('laporan.pelanggaran') ? 'active' : '' }}">
                        <i class="fas fa-file-medical-alt"></i>
                        <span>Laporan Pelanggaran</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="sidebar-brand" style="color: var(--sidebar-bg)">
                    <div class="brand-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <span class="brand-text" style="color: var(--sidebar-bg)">SMKN 1 CIOMAS</span>
                </div>
                <button class="navbar-toggler" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>

    <!-- QR Modal -->
    <div class="modal fade" id="qrScannerModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold">QR Scanner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div id="qr-reader" class="mb-3"></div>
                    <p class="text-muted">Arahkan kamera ke QR Code siswa</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('sidebarOverlay');

            if(toggle) {
                toggle.addEventListener('click', () => {
                    sidebar.classList.add('show');
                    overlay.classList.add('show');
                });
            }

            if(overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });

        function openQRScanner() {
            const modal = new bootstrap.Modal(document.getElementById('qrScannerModal'));
            modal.show();
        }
    </script>
</body>
</html>
