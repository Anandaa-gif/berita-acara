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
                    <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-history me-2 text-primary"></i> Berita Acara Terbaru</h6>
                    <a href="{{ route('berita-acara.index') }}" class="btn btn-sm btn-light rounded-pill px-3">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-muted fw-bold small text-uppercase">Pelanggan</th>
                                <th class="py-3 text-muted fw-bold small text-uppercase">Tanggal Registrasi</th>
                                <th class="py-3 text-muted fw-bold small text-uppercase">Paket</th>
                                <th class="text-end pe-4 py-3 text-muted fw-bold small text-uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_ba as $ba)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $ba->nama }}</div>
                                    <small class="text-muted text-xs d-block">{{ Str::limit($ba->alamat, 40) }}</small>
                                </td>
                                <td>
                                    <div class="text-dark fw-medium">{{ \Carbon\Carbon::parse($ba->tanggal_registrasi)->format('d M Y') }}</div>
                                    <small class="text-muted small">ID: {{ substr($ba->id, 0, 8) }}</small>
                                </td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3">
                                        {{ $ba->paket_berlangganan }}
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('berita-acara.show', $ba->id) }}" class="btn btn-sm btn-outline-primary border-0 rounded-circle" title="Detail">
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-25"></i>
                                    Belum ada data terbaru.
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
