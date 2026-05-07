@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Detail Backbone & ODP</h3>
            <p class="text-muted mb-0">Rincian data infrastruktur dan pengukuran redaman.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('backbone.index') }}" class="btn btn-light px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="button" class="btn btn-warning px-4 btn-edit-backbone-page" data-id="{{ $backbone->id }}">
                <i class="fas fa-edit me-2"></i> Edit Data
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Informasi Lokasi -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Informasi Lokasi</h6>
            </div>
            <div class="card-body">
                <div class="mb-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-network-wired fa-3x"></i>
                    </div>
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1 rounded-pill mb-2 d-inline-block">{{ $backbone->jenis_kegiatan ?? 'UP ODP' }}</span>
                    <h5 class="fw-bold text-dark mb-1">{{ $backbone->lokasi }}</h5>
                    @if($backbone->tiang_odp)
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill mt-2">Tiang: {{ $backbone->tiang_odp }}</span>
                    @endif
                </div>

                <div class="info-list">
                    @if($backbone->titik_koordinat)
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Titik Koordinat</span>
                        <span class="text-dark fw-medium font-monospace">{{ $backbone->titik_koordinat }}</span>
                    </div>
                    @endif
                    @if($backbone->jenis_kegiatan != 'Backbone')
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Ratio / Splitter</span>
                        <span class="text-dark fw-medium">{{ $backbone->ratio ?? '-' }} / {{ $backbone->splitter ?? '-' }}</span>
                    </div>
                    @endif
                    <div class="d-flex justify-content-between py-3">
                        <span class="text-muted small text-uppercase fw-bold">Waktu Input</span>
                        <span class="text-dark fw-medium">{{ $backbone->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Teknis & Redaman -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-signal me-2 text-success"></i> Pengukuran Redaman</h6>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-4 text-center border-start border-4 border-success">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold">Redaman Input</small>
                            <h3 class="fw-bold text-success mb-0">{{ $backbone->redaman_input ?? '-' }} <small class="fs-6">dBm</small></h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4 bg-light rounded-4 text-center border-start border-4 border-danger">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold">Redaman Output</small>
                            <h3 class="fw-bold text-danger mb-0">{{ $backbone->redaman_output ?? '-' }} <small class="fs-6">dBm</small></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tindakan & Teknisi -->
        <div class="row g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 border-0">
                        <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-camera me-2 text-primary"></i> Dokumentasi Lapangan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @if($backbone->foto_1)
                            <div class="col-md-6">
                                <div class="rounded-3 overflow-hidden border">
                                    <img src="{{ Storage::url($backbone->foto_1) }}" class="img-fluid w-100" alt="Dokumentasi 1" style="max-height: 300px; object-fit: cover;">
                                </div>
                                <small class="text-muted d-block mt-2 text-center">Foto Dokumentasi 1</small>
                            </div>
                            @endif
                            @if($backbone->foto_2)
                            <div class="col-md-6">
                                <div class="rounded-3 overflow-hidden border">
                                    <img src="{{ Storage::url($backbone->foto_2) }}" class="img-fluid w-100" alt="Dokumentasi 2" style="max-height: 300px; object-fit: cover;">
                                </div>
                                <small class="text-muted d-block mt-2 text-center">Foto Dokumentasi 2</small>
                            </div>
                            @endif
                            @if(!$backbone->foto_1 && !$backbone->foto_2)
                            <div class="col-12 text-center py-4">
                                <i class="fas fa-image fa-3x text-light mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada foto dokumentasi.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3">Tindakan Dilakukan:</h6>
                                <div class="p-3 bg-light rounded-3 text-dark small border">
                                    {{ $backbone->action ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark mb-3">Tim Teknisi:</h6>
                                @php
                                    $teknisi = array_filter([
                                        $backbone->tehnisi_1, 
                                        $backbone->tehnisi_2, 
                                        $backbone->tehnisi_3, 
                                        $backbone->tehnisi_4, 
                                        $backbone->tehnisi_5
                                    ]);
                                @endphp
                                
                                @foreach($teknisi as $index => $nama)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; font-size: 0.7rem;">
                                        {{ $loop->iteration }}
                                    </div>
                                    <span class="text-dark fw-medium small">{{ $nama }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="fw-bold text-dark mb-2">Keterangan:</h6>
                            <p class="text-muted small mb-0">{{ $backbone->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<div class="modal fade" id="backboneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="backboneModalLabel">Edit Data Backbone</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="backboneForm" action="{{ route('backbone.update', $backbone->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    @include('backbone._form')
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
        $('.btn-edit-backbone-page').on('click', function() {
            $('#jenis_kegiatan').val("{{ $backbone->jenis_kegiatan ?? 'UP ODP' }}");
            $('#lokasi').val("{{ $backbone->lokasi }}");
            $('#tiang_odp').val("{{ $backbone->tiang_odp }}");
            $('#titik_koordinat').val("{{ $backbone->titik_koordinat }}");
            $('#action').val("{{ $backbone->action }}");
            $('#ratio').val("{{ $backbone->ratio }}");
            $('#splitter').val("{{ $backbone->splitter }}");
            $('#redaman_input').val("{{ $backbone->redaman_input }}");
            $('#redaman_output').val("{{ $backbone->redaman_output }}");
            $('#tehnisi_1').val("{{ $backbone->tehnisi_1 }}");
            $('#tehnisi_2').val("{{ $backbone->tehnisi_2 }}");
            $('#tehnisi_3').val("{{ $backbone->tehnisi_3 }}");
            $('#tehnisi_4').val("{{ $backbone->tehnisi_4 }}");
            $('#tehnisi_5').val("{{ $backbone->tehnisi_5 }}");
            $('#keterangan').val("{{ $backbone->keterangan }}");
            
            if (typeof toggleFields === "function") {
                toggleFields();
            }
            
            $('#backboneModal').modal('show');
        });
    });
</script>
@endsection
