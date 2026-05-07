@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Data Backbone & ODP</h3>
            <p class="text-muted mb-0">Manajemen titik distribusi ODP, pengukuran redaman, dan rincian splitter.</p>
        </div>
        <button type="button" class="btn btn-primary px-4" id="btnCreateBackbone">
            <i class="fas fa-plus me-2"></i> Tambah Data
        </button>
    </div>
@endsection

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('backbone.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0 shadow-none" placeholder="Cari lokasi atau tiang..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-calendar text-muted"></i></span>
                    <input type="date" name="start_date" class="form-control bg-light border-0 shadow-none" title="Dari Tanggal" value="{{ request('start_date') }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-calendar text-muted"></i></span>
                    <input type="date" name="end_date" class="form-control bg-light border-0 shadow-none" title="Sampai Tanggal" value="{{ request('end_date') }}">
                </div>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4 shadow-sm flex-grow-1">Filter</button>
                @if(request('search') || request('start_date') || request('end_date'))
                    <a href="{{ route('backbone.index') }}" class="btn btn-light shadow-sm" title="Reset Filter">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive" style="min-height: 450px;">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase fw-bold">
                    <tr>
                        <th class="ps-4 py-3" style="width: 50px;">#</th>
                        <th class="py-3">Kegiatan & Lokasi</th>
                        <th>Tiang / Koordinat</th>
                        <th>Ratio & Redaman</th>
                        <th>Tim Teknisi</th>
                        <th>Keterangan</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($backbones as $b)
                    <tr>
                        <td class="ps-4 fw-bold text-muted small">
                            {{ ($backbones->currentPage() - 1) * $backbones->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-bold text-primary">{{ $b->jenis_kegiatan ?? 'UP ODP' }}</div>
                            <small class="text-dark fw-medium d-block mt-1"><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $b->lokasi }}</small>
                            @if($b->action)
                                <span class="badge bg-light text-dark fw-semibold border-0 mt-1" style="font-size: 0.7rem;">Action: {{ $b->action }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark small">
                                @if($b->tiang_odp)
                                    <i class="fas fa-map-pin me-1 text-primary"></i> {{ $b->tiang_odp }}
                                @else
                                    <span class="text-muted">---</span>
                                @endif
                            </div>
                            @if($b->titik_koordinat)
                                <div class="text-xs font-monospace mt-1"><span class="text-muted">COORD:</span> {{ $b->titik_koordinat }}</div>
                            @endif
                        </td>
                        <td>
                            @if($b->ratio || $b->splitter)
                            <div class="d-flex gap-1 mb-1">
                                <span class="badge bg-info bg-opacity-10 text-info border-0 rounded-pill px-2">Ratio: {{ $b->ratio ?? '-' }}</span>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 rounded-pill px-2">{{ $b->splitter ?? '-' }}</span>
                            </div>
                            @endif
                            @if($b->redaman_input || $b->redaman_output)
                            <div class="d-flex gap-2 align-items-center mt-1">
                                <div class="text-xs">
                                    <span class="text-success fw-bold">In: {{ $b->redaman_input ?? '-' }}</span>
                                </div>
                                <div class="text-xs">
                                    <span class="text-danger fw-bold">Out: {{ $b->redaman_output ?? '-' }}</span>
                                </div>
                            </div>
                            @else
                                <span class="text-muted small">---</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold text-dark small">{{ $b->tehnisi_1 }}</div>
                            @php
                                $others = collect([$b->tehnisi_2, $b->tehnisi_3, $b->tehnisi_4, $b->tehnisi_5])->filter()->count();
                            @endphp
                            @if($others > 0)
                                <span class="badge bg-light text-muted border-0 small">+{{ $others }} Teknisi</span>
                            @endif
                        </td>
                        <td>
                            <div class="text-dark fw-medium small text-truncate" style="max-width: 150px;" title="{{ $b->keterangan }}">{{ $b->keterangan ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="text-dark fw-bold">{{ $b->created_at->format('d/m/Y') }}</div>
                            <small class="text-dark fw-medium small">{{ $b->created_at->format('H:i') }} WIB</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-pill px-3 shadow-none border" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2" style="border-radius: 16px; min-width: 200px;">
                                    <div class="px-3 py-2 mb-1 border-bottom">
                                        <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem; letter-spacing: 1px;">Opsi Backbone</p>
                                    </div>
                                    <a class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1" href="{{ route('backbone.show', $b->id) }}">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-eye small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Lihat Detail</span>
                                    </a>

                                    @if(Auth::user()->hasPermission('backbone_edit'))
                                    <button type="button" class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1 btn-edit-backbone" data-id="{{ $b->id }}">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-edit small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Edit Data</span>
                                    </button>
                                    @endif

                                    @if(Auth::user()->hasPermission('backbone_delete'))
                                    <div class="border-top my-1 opacity-50"></div>
                                    <button type="button" class="dropdown-item d-flex align-items-center rounded-3 py-2 text-danger btn-delete-backbone" data-id="{{ $b->id }}" data-name="{{ $b->tiang_odp }}">
                                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-trash-alt small"></i>
                                        </div>
                                        <span class="fw-bold small">Hapus Data</span>
                                    </button>
                                    <form id="delete-form-backbone-{{ $b->id }}" action="{{ route('backbone.destroy', $b->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="fas fa-network-wired fa-3x mb-3 d-block opacity-25"></i>
                            <p class="mb-0">Belum ada data backbone.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($backbones->hasPages())
    <div class="card-footer bg-white py-3 border-0">
        <div class="d-flex justify-content-center">
            {{ $backbones->links() }}
        </div>
    </div>
    @endif
</div>

@push('modals')
<div class="modal fade" id="backboneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="backboneModalLabel">Data Backbone</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="backboneForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="backboneMethodContainer"></div>
                <div class="modal-body p-4">
                    @include('backbone._form')
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5 fw-bold rounded-3" id="btnSaveBackbone">Simpan Data</button>
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
        $('#btnCreateBackbone').on('click', function() {
            $('#backboneModalLabel').text('Tambah Data Backbone');
            $('#backboneForm').attr('action', "{{ route('backbone.store') }}");
            $('#backboneMethodContainer').html('');
            $('#backboneForm')[0].reset();
            if (typeof toggleFields === "function") {
                toggleFields();
            }
            $('#btnSaveBackbone').text('Simpan Data');
            $('#backboneModal').modal('show');
        });

        $(document).on('click', '.btn-edit-backbone', function() {
            let id = $(this).data('id');
            let btn = $(this);
            let originalContent = btn.html();
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ url('backbone') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#backboneModalLabel').text('Edit Data Backbone');
                    $('#backboneForm').attr('action', "{{ url('backbone') }}/" + id);
                    $('#backboneMethodContainer').html('@method("PUT")');
                    
                    $('#jenis_kegiatan').val(data.jenis_kegiatan || 'UP ODP');
                    $('#lokasi').val(data.lokasi);
                    $('#tiang_odp').val(data.tiang_odp);
                    $('#titik_koordinat').val(data.titik_koordinat);
                    $('#action').val(data.action);
                    $('#ratio').val(data.ratio);
                    $('#splitter').val(data.splitter);
                    $('#redaman_input').val(data.redaman_input);
                    $('#redaman_output').val(data.redaman_output);
                    $('#tehnisi_1').val(data.tehnisi_1);
                    $('#tehnisi_2').val(data.tehnisi_2);
                    $('#tehnisi_3').val(data.tehnisi_3);
                    $('#tehnisi_4').val(data.tehnisi_4);
                    $('#tehnisi_5').val(data.tehnisi_5);
                    $('#keterangan').val(data.keterangan);
                    
                    if (typeof toggleFields === "function") {
                        toggleFields();
                    }
                    
                    $('#btnSaveBackbone').text('Perbarui Data');
                    btn.prop('disabled', false).html(originalContent);
                    $('#backboneModal').modal('show');
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalContent);
                    Swal.fire('Error', 'Gagal mengambil data', 'error');
                }
            });
        });

        $(document).on('click', '.btn-delete-backbone', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Data?',
                text: "Anda akan menghapus data ODP " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-backbone-' + id).submit();
                }
            })
        });
    });
</script>
@endsection
