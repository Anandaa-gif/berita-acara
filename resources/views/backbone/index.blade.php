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
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase fw-bold">
                    <tr>
                        <th class="ps-4 py-3" style="width: 50px;">#</th>
                        <th class="py-3">Lokasi / Tiang</th>
                        <th>Ratio & Splitter</th>
                        <th>Redaman (In/Out)</th>
                        <th>Tim Teknisi</th>
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
                            <div class="fw-bold text-dark">{{ $b->lokasi }}</div>
                            <small class="text-primary fw-bold d-block mt-1"><i class="fas fa-map-pin me-1"></i> {{ $b->tiang_odp }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <span class="badge bg-info bg-opacity-10 text-info border-0 rounded-pill px-2">Ratio: {{ $b->ratio }}</span>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 rounded-pill px-2">{{ $b->splitter }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex gap-3 align-items-center">
                                <div class="text-xs">
                                    <span class="text-muted d-block small">INPUT</span>
                                    <span class="text-success fw-bold">{{ $b->redaman_input }} <small>dBm</small></span>
                                </div>
                                <div class="text-xs">
                                    <span class="text-muted d-block small">OUTPUT</span>
                                    <span class="text-danger fw-bold">{{ $b->redaman_output }} <small>dBm</small></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-dark fw-bold small">{{ $b->tehnisi_1 }}</div>
                            <div class="text-muted small">{{ $b->tehnisi_2 }}</div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group gap-1">
                                @if(Auth::user()->hasPermission('backbone_edit'))
                                <button type="button" class="btn btn-sm btn-outline-warning border-0 btn-edit-backbone rounded-circle" data-id="{{ $b->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif

                                @if(Auth::user()->hasPermission('backbone_delete'))
                                <button type="button" class="btn btn-sm btn-outline-danger border-0 btn-delete-backbone rounded-circle" data-id="{{ $b->id }}" data-name="{{ $b->tiang_odp }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-backbone-{{ $b->id }}" action="{{ route('backbone.destroy', $b->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
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
        {{ $backbones->links() }}
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
            <form id="backboneForm" method="POST">
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
                    $('#keterangan').val(data.keterangan);
                    
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
