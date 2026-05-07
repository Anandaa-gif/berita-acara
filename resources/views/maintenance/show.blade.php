@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Detail Maintenance</h3>
            <p class="text-muted mb-0">Rincian laporan perbaikan dan pemeliharaan pelanggan.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('maintenance.index') }}" class="btn btn-light px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="button" class="btn btn-warning px-4 btn-edit-maintenance-page" data-id="{{ $maintenance->id }}">
                <i class="fas fa-edit me-2"></i> Edit Data
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Informasi Pelanggan -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-user me-2 text-primary"></i> Informasi Pelanggan</h6>
            </div>
            <div class="card-body">
                <div class="mb-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-gear fa-3x"></i>
                    </div>
                    @if($maintenance->jenis_kegiatan)
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill mb-2 d-inline-block">{{ $maintenance->jenis_kegiatan }}</span>
                    @endif
                    <h5 class="fw-bold text-dark mb-1">{{ $maintenance->nama_pel }}</h5>
                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill mt-2">ID Laporan: #MNT-{{ str_pad($maintenance->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>

                <div class="info-list">
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Alamat</span>
                        <span class="text-dark fw-medium text-end" style="max-width: 60%;">{{ $maintenance->alamat_pel }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Tanggal Input</span>
                        <span class="text-dark fw-medium">{{ $maintenance->created_at->format('d F Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-3">
                        <span class="text-muted small text-uppercase fw-bold">Waktu</span>
                        <span class="text-dark fw-medium">{{ $maintenance->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rincian Masalah & Tindakan -->
    <div class="col-lg-7">
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-3 me-3">
                                <i class="fas fa-comment-dots fa-lg"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-dark">Keluhan / Masalah</h6>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-dark border-start border-4 border-warning">
                            {{ $maintenance->komplain }}
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 bg-success bg-opacity-10 text-success rounded-3 me-3">
                                <i class="fas fa-screwdriver-wrench fa-lg"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-dark">Tindakan / Solusi</h6>
                        </div>
                        <div class="p-3 bg-light rounded-3 text-dark border-start border-4 border-success">
                            {{ $maintenance->action }}
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="p-2 bg-info bg-opacity-10 text-info rounded-3 me-3">
                                <i class="fas fa-sticky-note fa-lg"></i>
                            </div>
                            <h6 class="mb-0 fw-bold text-dark">Keterangan Tambahan</h6>
                        </div>
                        <div class="text-muted italic">
                            {{ $maintenance->keterangan ?? 'Tidak ada keterangan tambahan.' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tim Teknisi -->
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-users me-2 text-primary"></i> Tim Teknisi Lapangan</h6>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded-4 bg-light">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.65rem;">Teknisi Utama</small>
                                <h6 class="mb-0 fw-bold text-dark">{{ $maintenance->tehnisi_1 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 border rounded-4 bg-light">
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                <i class="fas fa-user-gear"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block fw-bold text-uppercase" style="font-size: 0.65rem;">Teknisi Pendamping</small>
                                <h6 class="mb-0 fw-bold text-dark">{{ $maintenance->tehnisi_2 ?? '-' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<!-- Modal Edit tetap menggunakan modal yang ada di index agar konsisten -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="maintenanceModalLabel">Edit Laporan Maintenance</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="maintenanceForm" action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    @include('maintenance._form')
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5 fw-bold rounded-3">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-edit-maintenance-page').on('click', function() {
            let id = $(this).data('id');
            // Isi form dengan data yang sudah ada
            $('#jenis_kegiatan').val("{{ $maintenance->jenis_kegiatan }}");
            $('#nama_pel').val("{{ $maintenance->nama_pel }}");
            $('#alamat_pel').val("{{ $maintenance->alamat_pel }}");
            $('#komplain').val("{{ $maintenance->komplain }}");
            $('#action').val("{{ $maintenance->action }}");
            $('#tehnisi_1').val("{{ $maintenance->tehnisi_1 }}");
            $('#tehnisi_2').val("{{ $maintenance->tehnisi_2 }}");
            $('#keterangan').val("{{ $maintenance->keterangan }}");
            
            $('#maintenanceModal').modal('show');
        });
    });
</script>
@endsection
