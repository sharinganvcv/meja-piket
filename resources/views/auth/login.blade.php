<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMKN 1 CIOMAS - Login System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --accent: #f472b6;
            --bg-light: #f1f5f9;
            --glass: rgba(255, 255, 255, 0.9);
            --glass-border: #e2e8f0;
            --glass-blur: blur(20px);
            --text-primary: #0f172a;
            --text-secondary: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            background-image: 
                radial-gradient(at 0% 0%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(244, 114, 182, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(244, 114, 182, 0.08) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Abstract Shapes */
        .shape {
            position: absolute;
            z-index: -1;
            filter: blur(80px);
            border-radius: 50%;
        }
        .shape-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; left: -100px; opacity: 0.1; }
        .shape-2 { width: 300px; height: 300px; background: var(--accent); bottom: -50px; right: -50px; opacity: 0.1; }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-light);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1100px;
            display: flex;
            background: var(--glass);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Left Side - Branding */
        .brand-section {
            flex: 1.2;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.03), rgba(244, 114, 182, 0.03));
            border-right: 1px solid var(--glass-border);
            position: relative;
            overflow: hidden;
        }

        .brand-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://www.transparenttextures.com/patterns/cubes.png');
            opacity: 0.02;
            pointer-events: none;
        }

        .logo-box {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 3rem;
        }

        .logo-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .logo-circle i { font-size: 1.5rem; color: white; }

        .logo-text { font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 800; letter-spacing: -0.5px; color: #0f172a; }

        .hero-content h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }

        .hero-content p { font-size: 1.1rem; color: var(--text-secondary); line-height: 1.6; margin-bottom: 2.5rem; max-width: 400px; }

        .stats-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .stat-card {
            background: white;
            border: 1px solid var(--glass-border);
            padding: 1.5rem;
            border-radius: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .stat-card i { font-size: 1.5rem; color: var(--primary); margin-bottom: 10px; }
        .stat-card div { font-weight: 700; font-size: 1.1rem; color: #0f172a; }
        .stat-card span { font-size: 0.8rem; color: var(--text-secondary); }

        /* Right Side - Form */
        .form-section {
            flex: 1;
            padding: 4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .form-header { margin-bottom: 2.5rem; }
        .form-header h2 { font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; color: #0f172a; }
        .form-header p { color: var(--text-secondary); }

        .input-group-custom { position: relative; margin-bottom: 1.5rem; }
        .input-group-custom i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }
        .input-group-custom input {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 16px 16px 52px;
            color: #0f172a;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        .input-group-custom input:focus {
            outline: none;
            background: white;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }
        .input-group-custom input:focus + i { color: var(--primary); }

        .input-group-custom label {
            position: absolute;
            left: 52px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .input-group-custom input:focus ~ label,
        .input-group-custom input:not(:placeholder-shown) ~ label {
            top: -10px;
            left: 15px;
            font-size: 0.75rem;
            color: var(--primary);
            background: white;
            padding: 0 8px;
            border-radius: 4px;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white !important;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            margin-top: 1rem;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
            filter: brightness(1.1);
        }

        .checkbox-custom {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2rem;
            color: var(--text-secondary);
            font-size: 0.9rem;
            cursor: pointer;
        }

        .checkbox-custom input {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            accent-color: var(--primary);
        }

        .footer-links {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        .social-link-box {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 1rem;
        }

        .social-btn {
            width: 40px;
            height: 40px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-btn:hover { background: var(--primary); color: white; transform: scale(1.1); }

        .alert {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: 16px;
            padding: 12px 16px;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-alert {
            background: #dcfce7;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-wrapper { flex-direction: column; max-width: 500px; }
            .brand-section { padding: 3rem; border-right: none; border-bottom: 1px solid var(--glass-border); }
            .form-section { padding: 3rem; }
            .hero-content h1 { font-size: 2.5rem; }
        }

        @media (max-width: 576px) {
            body { padding: 15px; }
            .brand-section, .form-section { padding: 2rem; }
            .hero-content h1 { font-size: 2rem; }
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="login-wrapper">
        <!-- Left Side -->
        <div class="brand-section">
            <div class="logo-box">
                <div class="logo-circle">
                    <img src="https://i.ibb.co.com/4gXC7wj0/1630622969900.jpg" alt="Logo" style="width: 80%; height: 80%; object-fit: contain;">
                </div>
                <div class="logo-text">SMKN 1 CIOMAS</div>
            </div>

            <div class="hero-content">
                <h1>SMKN 1 CIOMAS</h1>
                <p>Kelola jadwal piket, presensi guru, dan izin siswa dalam satu platform digital yang terintegrasi.</p>
                
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-bolt"></i>
                        <div>Real-time</div>
                        <span>Data Terupdate</span>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-shield-alt"></i>
                        <div>Secure</div>
                        <span>Akses Terenkripsi</span>
                    </div>
                </div>
            </div>

            <div style="margin-top: 3rem; font-size: 0.8rem; color: var(--text-secondary); opacity: 0.5;">
                © 2024 SMKN 1 Ciomas • Education Excellence
            </div>
        </div>

        <!-- Right Side -->
        <div class="form-section">
            <div class="form-header">
                <h2>Selamat Datang</h2>
                <p>Silakan masuk untuk mengelola portal Anda</p>
            </div>

            @if (session('status'))
                <div class="alert success-alert">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="input-group-custom">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder=" " required autofocus autocomplete="username">
                    <i class="fas fa-envelope"></i>
                    <label for="email">Email Address</label>
                </div>
                @error('email')
                    <div class="alert" style="margin-top: -10px; margin-bottom: 20px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

                <!-- Password -->
                <div class="input-group-custom">
                    <input type="password" id="password" name="password" placeholder=" " required autocomplete="current-password">
                    <i class="fas fa-lock"></i>
                    <label for="password">Password</label>
                </div>
                @error('password')
                    <div class="alert" style="margin-top: -10px; margin-bottom: 20px;">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                @enderror

                <label class="checkbox-custom">
                    <input type="checkbox" name="remember">
                    <span>Ingat perangkat ini</span>
                </label>

                <button type="submit" class="btn btn-login">
                    <span>Masuk ke Panel</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

            <div class="footer-links">
                <p>Butuh bantuan akses?</p>
                <div class="social-link-box">
                    <a href="https://id.linkedin.com/school/smkn1ciomas/" target="_blank" class="social-btn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="social-btn">
                        <i class="fas fa-globe"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>