<!DOCTYPE html>
<html lang="en">
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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #4361ee 0%, #3f37c9 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        .brand-logo {
            width: 70px;
            height: 70px;
            background: #4361ee;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 16px rgba(67, 97, 238, 0.3);
        }

        .brand-logo i {
            color: white;
            font-size: 2.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e9ecef;
            background: #f8f9fa;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
            border-color: #4361ee;
            background: #fff;
        }

        .btn-login {
            background: #4361ee;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
            color: white;
            width: 100%;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: #304fd0;
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
            color: white;
        }

        .text-muted {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-logo">
            <i class="fas fa-file-invoice"></i>
        </div>
        <h4 class="text-center fw-bold mb-1">Selamat Datang</h4>
        <p class="text-center text-muted mb-4">Silakan login untuk akses dashboard</p>

        @if($errors->any())
        <div class="alert alert-danger border-0 py-2 small mb-4">
            <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="fas fa-user text-muted"></i>
                    </span>
                    <input type="text" name="username" class="form-control border-start-0" placeholder="Masukkan username" style="border-radius: 0 10px 10px 0;" required autofocus>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input type="password" id="password" name="password" class="form-control border-start-0 border-end-0" placeholder="Masukkan password" style="border-radius: 0;" required>
                    <button class="input-group-text bg-white border-start-0" type="button" id="togglePassword" style="border-radius: 0 10px 10px 0;">
                        <i class="fas fa-eye text-muted"></i>
                    </button>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small text-muted" for="remember">
                        Ingat Saya
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                Login ke Sistem <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center mt-4">
            <p class="text-muted mb-0">&copy; 2026 BA Instalasi Management</p>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
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
    </script>
</body>
</html>
