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
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase fw-bold">
                    <tr>
                        <th class="ps-4 py-3" style="width: 50px;">#</th>
                        <th class="py-3">Nama Pelanggan</th>
                        <th>Keluhan & Tindakan</th>
                        <th>Tim Teknisi</th>
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
                            <div class="fw-bold text-dark">{{ $m->nama_pel }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 250px;">{{ $m->alamat_pel }}</small>
                        </td>
                        <td>
                            <div class="text-dark fw-medium small"><i class="fas fa-exclamation-triangle text-warning me-1"></i> {{ Str::limit($m->komplain, 40) }}</div>
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
                            <div class="text-dark fw-medium">{{ $m->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted small">{{ $m->created_at->format('H:i') }} WIB</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group gap-1">
                                @if(Auth::user()->hasPermission('maintenance_edit'))
                                <button type="button" class="btn btn-sm btn-outline-warning border-0 btn-edit-maintenance rounded-circle" data-id="{{ $m->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif

                                @if(Auth::user()->hasPermission('maintenance_delete'))
                                <button type="button" class="btn btn-sm btn-outline-danger border-0 btn-delete-maintenance rounded-circle" data-id="{{ $m->id }}" data-name="{{ $m->nama_pel }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-maintenance-{{ $m->id }}" action="{{ route('maintenance.destroy', $m->id) }}" method="POST" style="display: none;">
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
        {{ $maintenances->links() }}
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
