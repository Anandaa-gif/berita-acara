@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Data Maintenance</h3>
            <p class="text-muted mb-0">Kelola laporan perbaikan dan pemeliharaan rutin jaringan pelanggan.</p>
        </div>
        <button type="button" class="btn btn-primary px-4" id="btnCreate">
            <i class="fas fa-plus me-2"></i> Tambah Laporan
        </button>
    </div>
@endsection

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('maintenance.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0 shadow-none" placeholder="Cari nama atau alamat..." value="{{ request('search') }}">
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
                    <a href="{{ route('maintenance.index') }}" class="btn btn-light shadow-sm" title="Reset Filter">
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
                        <th class="py-3">Nama Pelanggan</th>
                        <th>Keluhan & Tindakan</th>
                        <th>Tim Teknisi</th>
                        <th>Keterangan</th>
                        <th>Tanggal Input</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $m)
                    <tr>
                        <td class="ps-4 fw-bold text-muted small">
                            {{ ($maintenances->currentPage() - 1) * $maintenances->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            @if($m->jenis_kegiatan)
                                <div class="fw-bold text-primary small mb-1">{{ $m->jenis_kegiatan }}</div>
                            @endif
                            <div class="fw-bold text-dark">{{ $m->nama_pel }}</div>
                            <small class="text-dark fw-medium d-block text-truncate" style="max-width: 250px;">{{ $m->alamat_pel }}</small>
                        </td>
                        <td>
                            <div class="text-dark fw-bold small"><i class="fas fa-exclamation-triangle text-warning me-1"></i> {{ Str::limit($m->komplain, 40) }}</div>
                            <div class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> {{ Str::limit($m->action, 40) }}</div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill small">{{ $m->tehnisi_1 }}</span>
                                @if($m->tehnisi_2)
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-pill small">{{ $m->tehnisi_2 }}</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="text-dark fw-medium small text-truncate" style="max-width: 150px;" title="{{ $m->keterangan }}">{{ $m->keterangan ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="text-dark fw-bold">{{ $m->created_at->format('d/m/Y') }}</div>
                            <small class="text-dark fw-medium small">{{ $m->created_at->format('H:i') }} WIB</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-pill px-3 shadow-none border" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2" style="border-radius: 16px; min-width: 200px;">
                                    <div class="px-3 py-2 mb-1 border-bottom">
                                        <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem; letter-spacing: 1px;">Opsi Maintenance</p>
                                    </div>
                                    <a class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1" href="{{ route('maintenance.show', $m->id) }}">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-eye small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Lihat Detail</span>
                                    </a>

                                    @if(Auth::user()->hasPermission('maintenance_edit'))
                                    <button type="button" class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1 btn-edit-maintenance" data-id="{{ $m->id }}">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-edit small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Edit Laporan</span>
                                    </button>
                                    @endif

                                    @if(Auth::user()->hasPermission('maintenance_delete'))
                                    <div class="border-top my-1 opacity-50"></div>
                                    <button type="button" class="dropdown-item d-flex align-items-center rounded-3 py-2 text-danger btn-delete-maintenance" data-id="{{ $m->id }}" data-name="{{ $m->nama_pel }}">
                                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-trash-alt small"></i>
                                        </div>
                                        <span class="fw-bold small">Hapus Laporan</span>
                                    </button>
                                    <form id="delete-form-maintenance-{{ $m->id }}" action="{{ route('maintenance.destroy', $m->id) }}" method="POST" style="display: none;">
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fas fa-tools fa-3x mb-3 d-block opacity-25"></i>
                            <p class="mb-0">Belum ada data laporan maintenance.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($maintenances->hasPages())
    <div class="card-footer bg-white py-3 border-0">
        <div class="d-flex justify-content-center">
            {{ $maintenances->links() }}
        </div>
    </div>
    @endif
</div>

@push('modals')
<!-- Modal Maintenance -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="maintenanceModalLabel">Laporan Maintenance</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="maintenanceForm" method="POST">
                @csrf
                <div id="methodContainer"></div>
                <div class="modal-body p-4">
                    @include('maintenance._form')
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5 fw-bold rounded-3" id="btnSave">Simpan Laporan</button>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#btnCreate').on('click', function() {
            $('#maintenanceModalLabel').text('Tambah Laporan Maintenance');
            $('#maintenanceForm').attr('action', "{{ route('maintenance.store') }}");
            $('#methodContainer').html('');
            $('#maintenanceForm')[0].reset();
            $('#btnSave').text('Simpan Laporan');
            $('#maintenanceModal').modal('show');
        });

        $(document).on('click', '.btn-edit-maintenance', function() {
            let id = $(this).data('id');
            let btn = $(this);
            let originalContent = btn.html();
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ url('maintenance') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#maintenanceModalLabel').text('Edit Laporan Maintenance');
                    $('#maintenanceForm').attr('action', "{{ url('maintenance') }}/" + id);
                    $('#methodContainer').html('@method("PUT")');
                    
                    $('#jenis_kegiatan').val(data.jenis_kegiatan);
                    $('#nama_pel').val(data.nama_pel);
                    $('#alamat_pel').val(data.alamat_pel);
                    $('#komplain').val(data.komplain);
                    $('#action').val(data.action);
                    $('#tehnisi_1').val(data.tehnisi_1);
                    $('#tehnisi_2').val(data.tehnisi_2);
                    $('#keterangan').val(data.keterangan);
                    
                    $('#btnSave').text('Perbarui Laporan');
                    btn.prop('disabled', false).html(originalContent);
                    $('#maintenanceModal').modal('show');
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalContent);
                    Swal.fire('Error', 'Gagal mengambil data', 'error');
                }
            });
        });

        $(document).on('click', '.btn-delete-maintenance', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Laporan?',
                text: "Anda akan menghapus data maintenance milik " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-maintenance-' + id).submit();
                }
            })
        });
    });
</script>
@endsection
