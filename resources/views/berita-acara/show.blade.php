@extends('layouts.admin')

@section('content')
<div class="row g-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-2">
        <div>
            <h3 class="fw-bold text-dark">Detail Berita Acara</h3>
            <p class="text-muted mb-0">Informasi lengkap pemasangan baru.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('berita-acara.download-pdf', $beritaAcara->id) }}" class="btn btn-danger px-4 fw-bold shadow-sm">
                <i class="fas fa-file-pdf me-2"></i> Cetak PDF
            </a>
            <a href="{{ route('berita-acara.index') }}" class="btn btn-light px-4 fw-bold shadow-sm border">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            @if(Auth::user()->hasPermission('berita_acara_edit'))
            <a href="{{ route('berita-acara.edit', $beritaAcara->id) }}" class="btn btn-warning px-4 fw-bold shadow-sm">
                <i class="fas fa-edit me-2"></i> Edit Data
            </a>
            @endif
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <h5 class="fw-bold text-primary mb-0"><i class="fas fa-user-circle me-2"></i> Informasi Pelanggan</h5>
                    <span class="badge bg-light text-primary border border-primary-subtle rounded-pill px-3">
                        ID: {{ Str::limit($beritaAcara->id, 8, '') }}
                    </span>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Nama Lengkap</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->nama }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Nomor KTP</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->no_ktp }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Email</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">No. HP / WhatsApp</label>
                        <p class="mb-0">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', substr($beritaAcara->no_hp, 0, 1) == '0' ? '62' . substr($beritaAcara->no_hp, 1) : $beritaAcara->no_hp) }}" target="_blank" class="text-dark fw-bold text-decoration-none">
                                <i class="fab fa-whatsapp text-success me-1"></i> {{ $beritaAcara->no_hp }}
                            </a>
                        </p>
                    </div>
                    <div class="col-12">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Alamat Pemasangan</label>
                        <p class="text-dark fw-bold mb-2">{{ $beritaAcara->alamat }}</p>
                        @if($beritaAcara->google_maps_link)
                            <a href="{{ $beritaAcara->google_maps_link }}" target="_blank" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="fas fa-map-marker-alt me-1"></i> Buka di Google Maps
                            </a>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-5 mb-4 pb-2 border-bottom">
                    <h5 class="fw-bold text-primary mb-0"><i class="fas fa-concierge-bell me-2"></i> Detail Layanan</h5>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Tanggal Registrasi</label>
                        <p class="text-dark fw-bold mb-0">{{ \Carbon\Carbon::parse($beritaAcara->tanggal_registrasi)->format('d F Y') }}</p>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Paket Berlangganan</label>
                        <span class="badge bg-primary rounded-pill px-3">{{ $beritaAcara->paket_berlangganan }}</span>
                    </div>
                    <div class="col-md-4">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Biaya Registrasi</label>
                        <p class="text-dark fw-bold mb-0">Rp {{ number_format($beritaAcara->biaya_registrasi, 0, ',', '.') }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Jenis Perangkat</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->jenis_perangkat }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">MAC Address</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->mac_address ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Serial Number (SN)</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->serial_number ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-1">Tim Teknisi</label>
                        <p class="text-dark fw-bold mb-0">{{ $beritaAcara->nama_teknisi_1 }} {{ $beritaAcara->nama_teknisi_2 ? '& ' . $beritaAcara->nama_teknisi_2 : '' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold text-primary mb-4 pb-2 border-bottom"><i class="fas fa-images me-2"></i> Dokumentasi Lapangan</h5>
                <div class="row g-3">
                    <div class="col-md-4 text-center">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-2">Foto ODP</label>
                        @if($beritaAcara->foto_odp)
                            <a href="{{ Storage::url($beritaAcara->foto_odp) }}" target="_blank">
                                <img src="{{ Storage::url($beritaAcara->foto_odp) }}" class="img-fluid rounded shadow-sm hover-zoom" style="max-height: 200px; object-fit: cover; width: 100%;">
                            </a>
                        @else
                            <div class="bg-light rounded p-4 text-muted border border-dashed">
                                <i class="fas fa-image fa-3x mb-2 d-block opacity-25"></i>
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-2">Foto Rumah</label>
                        @if($beritaAcara->foto_rumah)
                            <a href="{{ Storage::url($beritaAcara->foto_rumah) }}" target="_blank">
                                <img src="{{ Storage::url($beritaAcara->foto_rumah) }}" class="img-fluid rounded shadow-sm hover-zoom" style="max-height: 200px; object-fit: cover; width: 100%;">
                            </a>
                        @else
                            <div class="bg-light rounded p-4 text-muted border border-dashed">
                                <i class="fas fa-image fa-3x mb-2 d-block opacity-25"></i>
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 text-center">
                        <label class="text-muted small text-uppercase fw-bold d-block mb-2">Foto Pelanggan</label>
                        @if($beritaAcara->foto_pelanggan)
                            <a href="{{ Storage::url($beritaAcara->foto_pelanggan) }}" target="_blank">
                                <img src="{{ Storage::url($beritaAcara->foto_pelanggan) }}" class="img-fluid rounded shadow-sm hover-zoom" style="max-height: 200px; object-fit: cover; width: 100%;">
                            </a>
                        @else
                            <div class="bg-light rounded p-4 text-muted border border-dashed">
                                <i class="fas fa-image fa-3x mb-2 d-block opacity-25"></i>
                                Tidak ada foto
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold text-dark mb-4 border-bottom pb-2">Konfirmasi Digital</h5>
                
                <div class="mb-4 text-center">
                    <label class="text-muted small text-uppercase fw-bold d-block mb-2">Tanda Tangan Pelanggan</label>
                    <div class="bg-light rounded p-3 border">
                        @if($beritaAcara->ttd_pelanggan)
                            <img src="{{ $beritaAcara->ttd_pelanggan }}" class="img-fluid" style="max-height: 120px;">
                        @else
                            <p class="text-muted mb-0 py-4 italic small">Belum ada tanda tangan</p>
                        @endif
                    </div>
                    <p class="small text-dark fw-bold mt-2 mb-0">{{ $beritaAcara->nama }}</p>
                    <small class="text-muted">(Pelanggan)</small>
                </div>

                <div class="text-center">
                    <label class="text-muted small text-uppercase fw-bold d-block mb-2">Tanda Tangan Petugas</label>
                    <div class="bg-light rounded p-3 border">
                        @if($beritaAcara->ttd_petugas)
                            <img src="{{ $beritaAcara->ttd_petugas }}" class="img-fluid" style="max-height: 120px;">
                        @else
                            <p class="text-muted mb-0 py-4 italic small">Belum ada tanda tangan</p>
                        @endif
                    </div>
                    <p class="small text-dark fw-bold mt-2 mb-0">{{ $beritaAcara->nama_teknisi_1 }}</p>
                    <small class="text-muted">(Teknisi Lapangan)</small>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

<style>
.hover-zoom:hover {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}
.border-dashed {
    border-style: dashed !important;
}
</style>
@endsection
