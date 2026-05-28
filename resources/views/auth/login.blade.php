<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Berita Acara Instalasi</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/mgdt.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-color: #f5f7fa;
            --bg-gradient: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-border: rgba(255, 255, 255, 0.2);
            --text-main: #2b2b36;
            --text-muted: #7e8299;
            --input-bg: #f8f9fa;
            --input-border: #e9ecef;
            --btn-bg: #4361ee;
            --btn-hover: #304fd0;
            --toggle-bg: #ffffff;
            --toggle-text: #4361ee;
        }

        [data-theme="dark"] {
            --bg-color: #121212;
            --bg-gradient: linear-gradient(135deg, #1e1e2d 0%, #151521 100%);
            --card-bg: rgba(30, 30, 45, 0.85);
            --card-border: rgba(255, 255, 255, 0.05);
            --text-main: #ffffff;
            --text-muted: #a1a5b7;
            --input-bg: #151521;
            --input-border: #323248;
            --btn-bg: #4361ee;
            --btn-hover: #4895ef;
            --toggle-bg: #1e1e2d;
            --toggle-text: #f6c343;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            position: relative;
            color: var(--text-main);
            transition: all 0.4s ease;
            overflow: hidden;
        }

        /* Abstract Background Shapes */
        .shape {
            position: absolute;
            filter: blur(80px);
            z-index: -1;
            animation: float 10s infinite ease-in-out alternate;
        }
        .shape-1 {
            width: 300px; height: 300px;
            background: rgba(67, 97, 238, 0.4);
            top: -50px; left: -50px;
            border-radius: 50%;
        }
        .shape-2 {
            width: 400px; height: 400px;
            background: rgba(114, 9, 183, 0.3);
            bottom: -100px; right: -100px;
            border-radius: 50%;
            animation-delay: -5s;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% { transform: translateY(0px) scale(1); }
            100% { transform: translateY(30px) scale(1.1); }
        }

        .login-card {
            background: var(--card-bg);
            backdrop-filter: blur(15px);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 90%;
            max-width: 420px;
            padding: 45px 40px;
            border: 1px solid var(--card-border);
            transition: all 0.4s ease;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .brand-logo {
            width: 90px;
            height: 90px;
            background: var(--btn-bg);
            border-radius: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.3);
            transition: transform 0.3s ease;
            padding: 15px;
        }

        .brand-logo:hover {
            transform: scale(1.05) rotate(-5deg);
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }

        .form-control, .input-group-text {
            background: var(--input-bg) !important;
            border: 1px solid var(--input-border) !important;
            color: var(--text-main) !important;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .input-group-text {
            color: var(--text-muted);
        }

        .input-group:focus-within .form-control,
        .input-group:focus-within .input-group-text {
            border-color: var(--btn-bg) !important;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }
        
        .input-group:focus-within .input-group-text i {
            color: var(--btn-bg) !important;
        }

        .btn-login {
            background: var(--btn-bg);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            color: white;
            width: 100%;
            margin-top: 25px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: var(--btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Theme Toggle Button */
        .theme-toggle {
            position: absolute;
            top: 25px;
            right: 25px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--toggle-bg);
            color: var(--toggle-text);
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 99;
        }

        .theme-toggle:hover {
            transform: scale(1.1) rotate(15deg);
        }
        
        .form-check-input {
            background-color: var(--input-bg);
            border-color: var(--input-border);
        }
        .form-check-input:checked {
            background-color: var(--btn-bg);
            border-color: var(--btn-bg);
        }
    </style>
</head>
<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <button class="theme-toggle" id="themeToggle" aria-label="Toggle Theme">
        <i class="fas fa-moon"></i>
    </button>

    <div class="login-card">
        <div class="brand-logo">
            <!-- Replaced generic icon with the MEGADATA logo -->
            <img src="{{ asset('storage/images/mgdt.png') }}" alt="Logo">
        </div>
        <h3 class="text-center fw-bold mb-2">Selamat Datang</h3>
        <p class="text-center text-muted mb-4">Silakan login untuk akses dashboard</p>

        @if($errors->any())
        <div class="alert alert-danger border-0 py-3 rounded-3 small mb-4 shadow-sm" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">USERNAME</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="border-radius: 12px 0 0 12px; padding-left: 15px;">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" class="form-control border-start-0 py-2" placeholder="Masukkan username" style="border-radius: 0 12px 12px 0;" required autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                <div class="input-group">
                    <span class="input-group-text border-end-0" style="border-radius: 12px 0 0 12px; padding-left: 15px;">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" id="password" name="password" class="form-control border-start-0 border-end-0 py-2" placeholder="Masukkan password" required>
                    <button class="input-group-text border-start-0 bg-transparent" type="button" id="togglePassword" style="border-radius: 0 12px 12px 0; padding-right: 15px; cursor: pointer;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small fw-medium" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                Login ke Sistem <i class="fas fa-sign-in-alt ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-5">
            <p class="text-muted mb-0" style="font-size: 0.75rem;">&copy; {{ date('Y') }} MEGADATA ISP BESUKI. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Password Toggle
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggle');
        const themeIcon = themeToggleBtn.querySelector('i');
        const htmlElement = document.documentElement;

        // Check for saved theme preference or system preference
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            htmlElement.setAttribute('data-theme', 'dark');
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        }

        // Toggle theme on button click
        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            if (newTheme === 'dark') {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        });
    </script>
</body>
</html>
