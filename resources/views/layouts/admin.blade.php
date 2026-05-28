<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEGADATA ISP - Admin Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/images/mgdt.png') }}" type="image/png">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --primary-light: #4895ef;
            --secondary-color: #3f37c9;
            --dark-color: #1e1e2d;
            --light-color: #f8f9fa;
            --sidebar-width: 260px;
            --navbar-height: 70px;
            --text-main: #2b2b36;
            --text-muted: #7e8299;
            --bg-main: #f5f7fa;
            --border-color: #eff2f5;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--dark-color);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            box-shadow: 10px 0 30px rgba(0,0,0,0.05);
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 30px 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
        }

        .sidebar-header h5 {
            margin: 0;
            font-weight: 800;
            letter-spacing: 1px;
            color: white;
            font-size: 1.1rem;
        }

        .sidebar-logo-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav-section-title {
            padding: 15px 25px 10px;
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 700;
            color: rgba(255,255,255,0.3);
            letter-spacing: 1.5px;
        }

        .nav-link {
            padding: 12px 25px;
            color: rgba(255,255,255,0.6);
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            margin: 4px 15px;
            border-radius: 10px;
        }

        .nav-link i {
            width: 20px;
            font-size: 1.1rem;
            transition: all 0.2s;
        }

        .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }

        .nav-link.active {
            color: white;
            background-color: var(--primary-color);
            box-shadow: 0 8px 20px rgba(67, 97, 238, 0.25);
        }

        .nav-link.active i {
            color: white;
        }

        /* Content Area */
        #content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar {
            height: var(--navbar-height);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-color);
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-brand {
            display: none;
        }

        .user-profile-btn {
            background: white;
            border: 1px solid var(--border-color);
            padding: 5px 15px;
            border-radius: 12px;
            transition: all 0.2s;
        }

        .user-profile-btn:hover {
            background: #f1f3f4;
            border-color: #dadce0;
        }

        /* Card Customization */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.03);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 20px 25px;
        }

        .card-body {
            padding: 25px;
        }

        /* Utility Classes */
        .badge-custom {
            padding: 6px 12px;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 8px;
        }

        .btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 97, 238, 0.3);
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            #sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
            }
            #sidebar.active {
                margin-left: 0;
            }
            #content {
                margin-left: 0;
            }
            .navbar-brand {
                display: block;
                font-weight: 800;
                color: var(--primary-color);
            }
        }

        /* Fade In Animation */
        .fade-in {
            animation: fadeIn 0.4s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #999;
        }
    </style>

    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo-icon">
                <img src="{{ asset('storage/images/mgdt.png') }}" alt="Logo">
            </div>
        </div>
        
        <div class="mt-2">
            <div class="nav-section-title">Overview</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i> Dashboard
            </a>

            <div class="nav-section-title">Layanan</div>
            @if(Auth::user()->hasPermission('berita_acara_view'))
            <a href="{{ route('berita-acara.index') }}" class="nav-link {{ request()->is('berita-acara*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice"></i> Berita Acara
            </a>
            @endif


            <div class="nav-section-title">Infrastruktur & Teknis</div>
            @if(Auth::user()->hasPermission('maintenance_view'))
            <a href="{{ route('maintenance.index') }}" class="nav-link {{ request()->is('maintenance*') ? 'active' : '' }}">
                <i class="fas fa-tools"></i> Maintenance
            </a>
            @endif

            @if(Auth::user()->hasPermission('vendor_view'))
            <a href="{{ route('vendor.index') }}" class="nav-link {{ request()->is('vendor*') ? 'active' : '' }}">
                <i class="fas fa-building"></i> Vendor
            </a>
            @endif

            @if(Auth::user()->hasPermission('backbone_view'))
            <a href="{{ route('backbone.index') }}" class="nav-link {{ request()->is('backbone*') ? 'active' : '' }}">
                <i class="fas fa-network-wired"></i> Backbone & ODP 
            </a>
            @endif

            @if(Auth::user()->role && Auth::user()->role->slug == 'admin')
            <div class="nav-section-title">System Management</div>
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Kelola User
            </a>
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->is('roles*') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Role & Hak Akses
            </a>
            <a href="{{ route('settings.whatsapp') }}" class="nav-link {{ request()->is('settings/whatsapp*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i> Pengaturan Notifikasi
            </a>
            @endif
        </div>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid p-0">
                <button type="button" id="sidebarCollapse" class="btn btn-light me-3 border-0 shadow-none d-lg-none">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand d-flex d-lg-none align-items-center gap-2" href="#">
                    <img src="{{ asset('storage/images/mgdt.png') }}" alt="Logo" width="30" height="30" style="object-fit: contain;">
                    <span>MEGADATA</span>
                </a>
                
                <div class="ms-auto d-flex align-items-center">
                    <!-- Notifications -->
                    <div class="dropdown me-3 d-none d-md-block">
                        <a href="#" class="text-muted" data-bs-toggle="dropdown">
                            <i class="fas fa-bell fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-3 py-2 px-3" style="width: 300px;">
                            <li class="py-2 border-bottom">
                                <small class="fw-bold">Notifikasi</small>
                            </li>
                            <li class="py-3 text-center">
                                <small class="text-muted">Tidak ada notifikasi baru</small>
                            </li>
                        </ul>
                    </div>

                    <!-- User Profile -->
                    <div class="dropdown">
                        <button class="user-profile-btn d-flex align-items-center gap-2 border-0 bg-transparent shadow-none" type="button" data-bs-toggle="dropdown">
                            <div class="text-end me-2 d-none d-md-block">
                                <span class="d-block fw-bold text-dark" style="font-size: 0.85rem;">{{ Auth::user()->name }}</span>
                                <span class="text-muted" style="font-size: 0.7rem;">{{ Auth::user()->role->name ?? 'User' }}</span>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=4361ee&color=fff&bold=true" class="rounded-circle" width="38" height="38">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-2" style="min-width: 200px; border-radius: 12px;">
                            <li><a class="dropdown-item py-2 rounded-2" href="{{ route('profile.index') }}"><i class="fas fa-user-circle me-2"></i> Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 rounded-2 text-danger fw-bold">
                                        <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Body -->
        <div class="p-4 p-md-5 fade-in">
            <!-- Breadcrumbs / Page Title Placeholder -->
            <div class="row mb-4">
                <div class="col-12">
                    @yield('header')
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            // Sidebar Toggle
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            // Auto close mobile sidebar when clicking outside
            $(document).click(function(event) {
                if (!$(event.target).closest('#sidebar, #sidebarCollapse').length) {
                    $('#sidebar').removeClass('active');
                }
            });
        });
    </script>

    @yield('scripts')
    @stack('modals')
</body>
</html>
