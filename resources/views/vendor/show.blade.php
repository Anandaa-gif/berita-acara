@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Detail Kegiatan Vendor</h3>
            <p class="text-muted mb-0">Rincian log penarikan kabel dan aktivitas infrastruktur.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('vendor.index') }}" class="btn btn-light px-4">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <button type="button" class="btn btn-warning px-4 btn-edit-vendor-page" data-id="{{ $vendor->id }}">
                <i class="fas fa-edit me-2"></i> Edit Data
            </button>
        </div>
    </div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Informasi Utama -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Kegiatan</h6>
            </div>
            <div class="card-body">
                <div class="mb-4 text-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-building fa-3x"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">{{ $vendor->jenis_kegiatan }}</h5>
                    <span class="badge bg-light text-muted border px-3 py-2 rounded-pill"><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $vendor->lokasi }}</span>
                </div>

                <div class="info-list">
                    @if($vendor->action)
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Action</span>
                        <span class="text-dark fw-medium">{{ $vendor->action }}</span>
                    </div>
                    @endif
                    
                    @if($vendor->start_koordinat)
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Koordinat Start</span>
                        <span class="text-dark fw-medium font-monospace">{{ $vendor->start_koordinat }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Koordinat End</span>
                        <span class="text-dark fw-medium font-monospace">{{ $vendor->end_koordinat }}</span>
                    </div>
                    @elseif($vendor->koordinat)
                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Koordinat</span>
                        <span class="text-dark fw-medium font-monospace">{{ $vendor->koordinat }}</span>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between py-3 border-bottom">
                        <span class="text-muted small text-uppercase fw-bold">Waktu Input</span>
                        <span class="text-dark fw-medium">{{ $vendor->created_at->format('d F Y, H:i') }} WIB</span>
                    </div>
                    
                    @if($vendor->keterangan)
                    <div class="py-3">
                        <span class="text-muted small text-uppercase fw-bold d-block mb-2">Keterangan</span>
                        <p class="text-dark mb-0 bg-light p-3 rounded-3">{{ $vendor->keterangan }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Spesifikasi Detail -->
    <div class="col-lg-7">
        @if($vendor->panjang_kabel)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-network-wired me-2 text-info"></i> Spesifikasi Kabel</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Panjang Kabel</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->panjang_kabel ?? '-' }}</h5>
                        </div>
                    </div>
                    @if($vendor->banyak_core)
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Banyak Core</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->banyak_core }}</h5>
                        </div>
                    </div>
                    @endif
                    @if($vendor->jenis_kabel)
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Jenis Kabel</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->jenis_kabel }}</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($vendor->spliter)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-microchip me-2 text-info"></i> Spesifikasi ODP</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Spliter</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->spliter }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Ratio</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->ratio }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Red. Input</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->redaman_input }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-light rounded-4 text-center">
                            <small class="text-muted d-block mb-1 text-uppercase fw-bold" style="font-size: 0.6rem;">Red. Output</small>
                            <h5 class="fw-bold text-dark mb-0">{{ $vendor->redaman_output }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Tim Teknisi Vendor -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-0">
                <h6 class="mb-0 fw-bold text-dark"><i class="fas fa-users me-2 text-primary"></i> Tim Teknisi Vendor</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light small fw-bold text-muted">
                            <tr>
                                <th class="ps-4">No.</th>
                                <th>Nama Teknisi</th>
                                <th>Peran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-4">1</td>
                                <td class="fw-bold text-dark">{{ $vendor->tehnisi_1 }}</td>
                                <td><span class="badge bg-primary bg-opacity-10 text-primary">Teknisi Utama</span></td>
                            </tr>
                            @if($vendor->tehnisi_2)
                            <tr>
                                <td class="ps-4">2</td>
                                <td class="text-dark">{{ $vendor->tehnisi_2 }}</td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Pembantu</span></td>
                            </tr>
                            @endif
                            @if($vendor->tehnisi_3)
                            <tr>
                                <td class="ps-4">3</td>
                                <td class="text-dark">{{ $vendor->tehnisi_3 }}</td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Pembantu</span></td>
                            </tr>
                            @endif
                            @if($vendor->tehnisi_4)
                            <tr>
                                <td class="ps-4">4</td>
                                <td class="text-dark">{{ $vendor->tehnisi_4 }}</td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Pembantu</span></td>
                            </tr>
                            @endif
                            @if($vendor->tehnisi_5)
                            <tr>
                                <td class="ps-4">5</td>
                                <td class="text-dark">{{ $vendor->tehnisi_5 }}</td>
                                <td><span class="badge bg-secondary bg-opacity-10 text-secondary">Pembantu</span></td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('modals')
<div class="modal fade" id="vendorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="vendorModalLabel">Edit Data Vendor</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="vendorForm" action="{{ route('vendor.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    @include('vendor._form')
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
        $('.btn-edit-vendor-page').on('click', function() {
            $('#jenis_kegiatan').val("{{ $vendor->jenis_kegiatan }}");
            $('#lokasi').val("{{ $vendor->lokasi }}");
            $('#action').val("{{ $vendor->action }}");
            $('#start_koordinat').val("{{ $vendor->start_koordinat }}");
            $('#end_koordinat').val("{{ $vendor->end_koordinat }}");
            $('#koordinat').val("{{ $vendor->koordinat }}");
            $('#panjang_kabel').val("{{ $vendor->panjang_kabel }}");
            $('#banyak_core').val("{{ $vendor->banyak_core }}");
            $('#jenis_kabel').val("{{ $vendor->jenis_kabel }}");
            $('#spliter').val("{{ $vendor->spliter }}");
            $('#ratio').val("{{ $vendor->ratio }}");
            $('#redaman_input').val("{{ $vendor->redaman_input }}");
            $('#redaman_output').val("{{ $vendor->redaman_output }}");
            $('#keterangan').val("{{ $vendor->keterangan }}");
            $('#tehnisi_1').val("{{ $vendor->tehnisi_1 }}");
            $('#tehnisi_2').val("{{ $vendor->tehnisi_2 }}");
            $('#tehnisi_3').val("{{ $vendor->tehnisi_3 }}");
            $('#tehnisi_4').val("{{ $vendor->tehnisi_4 }}");
            $('#tehnisi_5').val("{{ $vendor->tehnisi_5 }}");
            
            if (typeof toggleFields === "function") {
                toggleFields();
            }
            
            $('#vendorModal').modal('show');
        });
    });
</script>
@endsection
