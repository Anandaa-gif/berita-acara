@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Ringkasan Sistem</h3>
            <p class="text-muted mb-0">Statistik dan aktivitas terbaru di jaringan MEGADATA.</p>
        </div>
        <div class="d-none d-md-block">
            <span class="badge bg-white text-dark border py-2 px-3 rounded-pill shadow-sm">
                <i class="far fa-calendar-alt me-2 text-primary"></i> {{ date('d M Y') }}
            </span>
        </div>
    </div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Stat Cards -->
    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-3 bg-primary bg-opacity-10 rounded-3 text-primary me-3">
                        <i class="fas fa-file-invoice fa-xl"></i>
                    </div>
                    <h6 class="text-muted mb-0 fw-semibold">Berita Acara</h6>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_ba'] }}</h2>
                    <span class="text-success small fw-bold"><i class="fas fa-arrow-up me-1"></i> Total BA</span>
                </div>
            </div>
            <div class="bg-primary bg-opacity-10 py-1"></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-warning me-3">
                        <i class="fas fa-tools fa-xl"></i>
                    </div>
                    <h6 class="text-muted mb-0 fw-semibold">Maintenance</h6>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_maintenance'] }}</h2>
                    <span class="text-warning small fw-bold">Laporan Aktif</span>
                </div>
            </div>
            <div class="bg-warning bg-opacity-10 py-1"></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-3 bg-success bg-opacity-10 rounded-3 text-success me-3">
                        <i class="fas fa-building fa-xl"></i>
                    </div>
                    <h6 class="text-muted mb-0 fw-semibold">Vendor</h6>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_vendor'] }}</h2>
                    <span class="text-success small fw-bold">Penarikan Kabel</span>
                </div>
            </div>
            <div class="bg-success bg-opacity-10 py-1"></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100 border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <div class="p-3 bg-info bg-opacity-10 rounded-3 text-info me-3">
                        <i class="fas fa-network-wired fa-xl"></i>
                    </div>
                    <h6 class="text-muted mb-0 fw-semibold">Backbone & ODP</h6>
                </div>
                <div class="d-flex align-items-end justify-content-between">
                    <h2 class="fw-bold mb-0 text-dark">{{ $stats['total_backbone'] }}</h2>
                    <span class="text-info small fw-bold">Infrastruktur</span>
                </div>
            </div>
            <div class="bg-info bg-opacity-10 py-1"></div>
        </div>
    </div>
</div>

<div class="row mt-4 g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-user-clock me-2 text-primary"></i> Riwayat Login Terbaru</h6>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-muted fw-bold small text-uppercase">Pengguna</th>
                                <th class="py-3 text-muted fw-bold small text-uppercase">Waktu Login</th>
                                <th class="py-3 text-muted fw-bold small text-uppercase">IP Address</th>
                                <th class="text-end pe-4 py-3 text-muted fw-bold small text-uppercase">Browser / Device</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($login_logs as $log)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $log->user->name ?? 'Unknown' }}</div>
                                    <small class="text-muted text-xs d-block">{{ $log->user->role->name ?? 'User' }}</small>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted small fw-medium">{{ $log->created_at->format('H:i:s') }} WIB</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3">
                                        {{ $log->ip_address ?? 'Unknown IP' }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="text-muted small text-truncate" style="max-width: 200px; display: inline-block;" title="{{ $log->user_agent }}">
                                        {{ $log->user_agent ?? 'Unknown Device' }}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-user-clock fa-3x mb-3 d-block opacity-25"></i>
                                    Belum ada riwayat login.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-bolt me-2 text-warning"></i> Aksi Cepat</h6>
            </div>
            <div class="card-body pt-0">
                <div class="d-grid gap-3">
                    <a href="{{ route('berita-acara.create') }}" class="quick-action-card p-3 rounded-4 border text-decoration-none transition-all">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary text-white me-3">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Laporan Baru</h6>
                                <small class="text-muted">Buat Berita Acara Pemasangan</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('maintenance.index') }}" class="quick-action-card p-3 rounded-4 border text-decoration-none transition-all">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-warning text-white me-3">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Maintenance</h6>
                                <small class="text-muted">Input Laporan Perbaikan</small>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('vendor.index') }}" class="quick-action-card p-3 rounded-4 border text-decoration-none transition-all">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success text-white me-3">
                                <i class="fas fa-building"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">Data Vendor</h6>
                                <small class="text-muted">Log Penarikan Kabel</small>
                            </div>
                        </div>
                    </a>
                    
                    <form action="{{ route('dashboard.test-telegram') }}" method="POST" id="testTelegramForm">
                        @csrf
                        <button type="submit" class="quick-action-card w-100 p-3 rounded-4 border text-decoration-none transition-all text-start bg-white">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-info text-white me-3">
                                    <i class="fab fa-telegram-plane"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">Test Bot Telegram</h6>
                                    <small class="text-muted">Cek Koneksi Bot & Grup</small>
                                </div>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .quick-action-card {
        border-color: var(--border-color) !important;
        background: white;
    }
    .quick-action-card:hover {
        background: #f8f9fa;
        transform: translateX(5px);
        border-color: var(--primary-color) !important;
    }
    .icon-box {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection
