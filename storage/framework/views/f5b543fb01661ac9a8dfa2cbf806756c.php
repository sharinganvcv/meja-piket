
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Eduspace')); ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #7c3aed;
            --secondary-color: #5b21b6;
            --accent-color: #6366f1;
            --sidebar-bg: #1a1a2e;
            --sidebar-text: #e2e8f0;
            --sidebar-hover: #2d2d3a;
            --card-shadow: 0 4px 6px rgba(124, 58, 237, 0.1);
            --border-color: #e5e7eb;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --bg-light: #f8fafc;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-light);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Main Layout */
        .main-layout {
            display: flex;
            min-height: 100vh;
        }

        .card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            color: var(--text-primary);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .sidebar {
            background: #ffffff;
            width: 240px;
            height: 100vh;
            max-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.04);
            border-right: 1px solid rgba(102, 126, 234, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1050;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar Header (Navbar Integration) */
        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 1.2rem;
            border-bottom: 1px solid rgba(102, 126, 234, 0.08);
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #2d3748;
            font-weight: 800;
            font-size: 1.25rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-brand img {
            height: 32px;
            width: auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .brand-text {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar User Section */
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.875rem;
            padding: 1rem 1.25rem;
            margin: 1rem;
            border-radius: 14px;
            background: #f8fafc;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar-user:hover {
            background: #fff;
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.12);
            transform: translateY(-2px);
            border-color: rgba(102, 126, 234, 0.3);
        }

        .sidebar-user .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.25);
            font-weight: 700;
        }

        .sidebar-user .user-info {
            flex: 1;
            min-width: 0;
        }

        .sidebar-user .user-name {
            font-size: 0.9rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-user .user-role {
            font-size: 0.75rem;
            color: #718096;
            font-weight: 600;
        }

        /* Sidebar Navigation */
        .sidebar-nav {
            padding: 0.5rem 1rem 1rem;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .nav-section {
            margin-bottom: 1.25rem;
        }

        .nav-section-title {
            color: #a0aec0;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.7rem;
            margin: 1.5rem 0 0.5rem 0.5rem;
        }

        .sidebar .nav-link {
            color: #4a5568;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0;
            border-radius: 12px;
            transition: all 0.25s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 0.88rem;
        }

        .sidebar .nav-link i {
            width: 22px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1.1rem;
            color: #a0aec0;
            transition: all 0.25s ease;
        }

        .sidebar .nav-link:hover {
            background: #f8fafc;
            color: #667eea;
            transform: translateX(4px);
        }

        .sidebar .nav-link:hover i {
            color: #667eea;
            transform: scale(1.1);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
            color: #667eea;
            font-weight: 700;
            border-right: 3px solid #667eea;
        }

        .sidebar .nav-link.active i {
            color: #667eea;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 1.25rem;
            margin-top: auto;
            background: #fff;
            border-top: 1px solid rgba(102, 126, 234, 0.08);
        }

        .logout-btn {
            width: 100%;
            background: #fff5f5;
            color: #e53e3e;
            border: 1px solid #fed7d7;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-size: 0.88rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #e53e3e;
            color: white;
            border-color: #e53e3e;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(229, 62, 62, 0.2);
        }

        .main-content {
            flex: 1;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            overflow-y: auto;
            transition: all 0.3s ease;
            color: #1e293b;
            position: relative;
            margin-left: 240px;
            min-height: 100vh;
            width: calc(100% - 240px);
        }

        .content-wrapper {
            padding: 1.5rem;
            max-width: 100%;
        }

        .min-h-screen {
            padding-top: 0;
        }

        /* Responsive Design - All Devices */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                width: 240px;
                max-width: 85vw;
                height: 100vh;
                z-index: 1050;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.25);
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1045;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .content-wrapper {
                padding: 1rem;
            }

            .sidebar-header {
                padding: 1rem;
            }

            .brand-text {
                display: block;
            }

            .sidebar-user {
                margin: 0.5rem;
            }

            .sidebar-nav {
                padding: 0.5rem;
            }

            .navbar-toggler {
                display: block !important;
                background: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.2);
                color: white;
                padding: 0.5rem 0.75rem;
                border-radius: 8px;
                cursor: pointer;
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 200px;
            }
            
            .main-content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }
            
            .sidebar-nav {
                padding: 0.75rem;
            }
            
            .sidebar .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.85rem;
            }
            
            .sidebar .nav-link i {
                width: 18px;
                font-size: 0.85rem;
                margin-right: 0.6rem;
            }
            
            .content-wrapper {
                padding: 1rem;
            }
        }

        @media (min-width: 1200px) {
            .sidebar {
                width: 220px;
            }
            
            .main-content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }
        }

        /* Tablet Specific */
        @media (min-width: 768px) and (max-width: 1024px) {
            .sidebar {
                width: 200px;
            }
            
            .sidebar-nav {
                padding: 0.75rem 0.5rem;
            }
        }

        /* Large Desktop */
        @media (min-width: 1400px) {
            .sidebar {
                width: 240px;
            }
            
            .main-content {
                margin-left: 240px;
                width: calc(100% - 240px);
            }
            
            .content-wrapper {
                padding: 1.5rem;
            }
        }

        /* Ultra-wide screens */
        @media (min-width: 1920px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
            
            .content-wrapper {
                max-width: 1800px;
                margin: 0 auto;
                padding: 2rem;
            }
        }

        /* Global Styles */
        * {
            box-sizing: border-box;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Table Styles */
        .table {
            background: white;
            border-radius: 0.75rem;
            overflow: hidden;
            color: #1e293b;
        }

        .table th {
            font-weight: 600;
            color: #1e293b;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        /* Card Header */
        .card-header h5 {
            font-size: 1rem;
            font-weight: 600;
        }

        /* Text Visibility */
        h1, h2, h3, h4, h5, h6 {
            color: #1e293b !important;
        }
        
        .text-dark {
            color: #1e293b !important;
        }
        
        .card {
            background: white !important;
            color: #1e293b !important;
        }
        
        .table {
            color: #1e293b !important;
        }
        
        .form-control {
            color: #1e293b !important;
            background-color: white !important;
        }
        
        .form-label {
            color: #1e293b !important;
        }
        
        /* WhatsApp Card Styles */
        .whatsapp-card {
            background: linear-gradient(135deg, #25d366, #128c7e);
            border: none;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(37, 211, 102, 0.3);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .whatsapp-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(37, 211, 102, 0.4);
        }

        .whatsapp-card .card-body {
            padding: 2rem;
        }

        .whatsapp-card .card-title {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .whatsapp-card .card-text {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .whatsapp-card .text-end p {
            color: white;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .whatsapp-card .btn-success {
            background: white;
            color: #25d366;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
        }

        .whatsapp-card .btn-success:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(255, 255, 255, 0.4);
            color: #128c7e;
        }

        .whatsapp-icon {
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .whatsapp-icon i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
    <!-- CSRF Meta Tag -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body class="font-sans antialiased">
    <div class="app-container">
        <!-- Main Layout Container -->
        <div class="main-layout">
            <!-- Sidebar dengan Navbar Terintegrasi -->
            <aside class="sidebar">
                <!-- Brand Section (Navbar) -->
                <div class="sidebar-header">
                    <div class="sidebar-brand">
                        <img src="<?php echo e(asset('logo-dark.svg')); ?>" alt="Eduspace" style="height: 35px; width: auto;">
                        <span class="brand-text">Eduspace</span>
                    </div>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="navbar-toggler d-md-none" type="button" id="mobileMenuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                
                <!-- User Profile Section -->
                <div class="sidebar-user">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-info">
                        <div class="user-name"><?php echo e(auth()->user()->name); ?></div>
                        <div class="user-role">
                            <?php if(auth()->user()->role === 'admin'): ?>
                                Administrator
                            <?php elseif(auth()->user()->role === 'kepsek'): ?>
                                Kepala Sekolah
                            <?php else: ?>
                                Guru Piket
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="sidebar-nav">
                    <a href="<?php echo e(route('dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                        <i class="fas fa-chart-line"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                    <div class="nav-section">
                        <div class="nav-section-title">DATA SISWA & GURU</div>
                        <a href="<?php echo e(route('siswa.index')); ?>" class="nav-link <?php echo e(request()->routeIs('siswa.*') ? 'active' : ''); ?>">
                            <i class="fas fa-users"></i>
                            <span>Siswa</span>
                        </a>
                        <a href="<?php echo e(route('guru.index')); ?>" class="nav-link <?php echo e(request()->routeIs('guru.*') ? 'active' : ''); ?>">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Guru</span>
                        </a>
                    </div>
                    
                    <div class="nav-section">
                        <div class="nav-section-title">PELANGGARAN</div>
                        <a href="<?php echo e(route('pelanggaran.index')); ?>" class="nav-link <?php echo e(request()->routeIs('pelanggaran.*') ? 'active' : ''); ?>">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Pelanggaran</span>
                        </a>
                        <a href="<?php echo e(route('pelanggaran.rekap')); ?>" class="nav-link <?php echo e(request()->routeIs('pelanggaran.rekap') ? 'active' : ''); ?>">
                            <i class="fas fa-chart-bar"></i>
                            <span>Rekap Pelanggaran</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(auth()->user()->role === 'guru'): ?>
                    <div class="nav-section">
                        <div class="nav-section-title">MANAJEMEN IZIN & KETERLAMBATAN</div>
                        <a href="<?php echo e(route('izin-keluar.index')); ?>" class="nav-link <?php echo e(request()->routeIs('izin-keluar.*') ? 'active' : ''); ?>">
                            <i class="fas fa-door-open"></i>
                            <span>Izin Keluar</span>
                        </a>
                        <a href="<?php echo e(route('keterlambatan.index')); ?>" class="nav-link <?php echo e(request()->routeIs('keterlambatan.*') ? 'active' : ''); ?>">
                            <i class="fas fa-clock"></i>
                            <span>Keterlambatan</span>
                        </a>
                    </div>
                    
                    <div class="nav-section">
                        <div class="nav-section-title">PELANGGARAN</div>
                        <a href="<?php echo e(route('pelanggaran.index')); ?>" class="nav-link <?php echo e(request()->routeIs('pelanggaran.*') ? 'active' : ''); ?>">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Pelanggaran</span>
                        </a>
                        <a href="<?php echo e(route('pelanggaran.rekap')); ?>" class="nav-link <?php echo e(request()->routeIs('pelanggaran.rekap') ? 'active' : ''); ?>">
                            <i class="fas fa-chart-bar"></i>
                            <span>Rekap Pelanggaran</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(auth()->user()->role === 'kepsek'): ?>
                    <div class="nav-section">
                        <div class="nav-section-title">LAPORAN & MONITORING</div>
                        <a href="<?php echo e(route('pelanggaran.index')); ?>" class="nav-link <?php echo e(request()->routeIs('pelanggaran.*') ? 'active' : ''); ?>">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Pelanggaran</span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(auth()->user()->role === 'guru'): ?>
                        <a href="#" onclick="openQRScanner()" class="nav-link">
                            <i class="fas fa-qrcode"></i>
                            <span>QR Scanner</span>
                        </a>
                    <?php endif; ?>
                </nav>
                
                <!-- Logout Button -->
                <div class="sidebar-footer">
                    <form method="POST" action="<?php echo e(route('logout')); ?>" onsubmit="return confirm('Apakah Anda yakin ingin logout?')">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <div class="content-wrapper">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(session('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php echo e(session('error')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo $__env->yieldContent('content'); ?>
                    <?php echo e($slot ?? ''); ?>

                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- QR Scanner Modal -->
    <div class="modal fade" id="qrScannerModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-qrcode me-2"></i>QR Code Scanner
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center py-4">
                        <div id="qr-reader" style="width: 100%;"></div>
                        <div id="qr-reader-results"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Performance optimizations
        let qrModal;
        let isProcessing = false;

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Preload modal
            qrModal = new bootstrap.Modal(document.getElementById('qrScannerModal'));
            
            // Optimize scroll performance
            let ticking = false;
            function updateScroll() {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        // Scroll handling code here if needed
                        ticking = false;
                    });
                    ticking = true;
                }
            }
            window.addEventListener('scroll', updateScroll, { passive: true });
            
            // Mobile menu toggle
            setupMobileMenu();
        });

        function setupMobileMenu() {
            const sidebar = document.querySelector('.sidebar');
            const toggleBtn = document.getElementById('mobileMenuToggle');
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            overlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1025;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            `;
            document.body.appendChild(overlay);
            
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });
            }
            
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
            
            // Handle window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    if (window.innerWidth > 768) {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    }
                }, 250);
            });
        }

        function openQRScanner() {
            if (isProcessing) return;
            
            qrModal.show();
            
            // Initialize QR Scanner immediately
            setTimeout(() => {
                const qrReader = document.getElementById('qr-reader');
                qrReader.innerHTML = `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        QR Scanner akan segera tersedia. Silakan input manual QR Code data untuk testing.
                    </div>
                    <div class="mb-3">
                        <label class="form-label">QR Code Data (Base64)</label>
                        <textarea class="form-control" id="qrManualInput" rows="3" 
                            placeholder="Masukkan QR Code data..."></textarea>
                    </div>
                    <button class="btn btn-primary" onclick="processQRData()">
                        <i class="fas fa-search me-2"></i>Scan Data
                    </button>
                `;
                
                // Focus on input immediately
                document.getElementById('qrManualInput').focus();
            }, 100);
        }
        
        function processQRData() {
            if (isProcessing) return;
            isProcessing = true;
            
            const qrData = document.getElementById('qrManualInput').value;
            if (!qrData) {
                alert('Silakan masukkan QR Code data');
                isProcessing = false;
                return;
            }
            
            // Show loading state
            const resultsDiv = document.getElementById('qr-reader-results');
            resultsDiv.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Processing...</p></div>';
            
            // Use fetch with timeout
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 10000);
            
            fetch('/api/qr-scan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ qr_data: qrData }),
                signal: controller.signal
            })
            .then(response => {
                clearTimeout(timeoutId);
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    resultsDiv.innerHTML = `
                        <div class="alert alert-success fade-in">
                            <h6><i class="fas fa-check-circle me-2"></i>Siswa Ditemukan!</h6>
                            <p><strong>Nama:</strong> ${data.data.nama}</p>
                            <p><strong>NIS:</strong> ${data.data.nis}</p>
                            <p><strong>Kelas:</strong> ${data.data.kelas}</p>
                            <p><strong>Total Poin:</strong> ${data.data.total_poin}</p>
                        </div>
                    `;
                    
                    // Auto-close modal after 2 seconds
                    setTimeout(() => {
                        qrModal.hide();
                        document.getElementById('qrManualInput').value = '';
                        document.getElementById('qr-reader-results').innerHTML = '';
                    }, 2000);
                } else {
                    resultsDiv.innerHTML = `
                        <div class="alert alert-danger fade-in">
                            <i class="fas fa-exclamation-triangle me-2"></i>${data.message}
                        </div>
                    `;
                }
            })
            .catch(error => {
                clearTimeout(timeoutId);
                console.error('Error:', error);
                resultsDiv.innerHTML = `
                    <div class="alert alert-danger fade-in">
                        <i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan saat memproses QR Code
                    </div>
                `;
            })
            .finally(() => {
                isProcessing = false;
            });
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K for QR Scanner
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                openQRScanner();
            }
            
            // Escape to close modal
            if (e.key === 'Escape' && qrModal._isShown) {
                qrModal.hide();
            }
        });

        // Optimize images
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                if (!img.complete) {
                    img.loading = 'lazy';
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\antigravity\website-sekolah-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>