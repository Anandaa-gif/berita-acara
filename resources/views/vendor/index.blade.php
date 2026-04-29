@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Data Kegiatan Vendor</h3>
            <p class="text-muted mb-0">Log aktivitas penarikan kabel, instalasi infrastruktur, dan teknisi vendor.</p>
        </div>
        <button type="button" class="btn btn-primary px-4" id="btnCreateVendor">
            <i class="fas fa-plus me-2"></i> Tambah Kegiatan
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
                        <th class="py-3">Kegiatan & Lokasi</th>
                        <th>Spesifikasi Kabel</th>
                        <th>Koordinat (S/E)</th>
                        <th>Tim Teknisi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($vendors as $v)
                    <tr>
                        <td class="ps-4 fw-bold text-muted small">
                            {{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-bold text-primary">{{ $v->jenis_kegiatan }}</div>
                            <small class="text-muted d-block mt-1"><i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $v->lokasi }}</small>
                        </td>
                        <td>
                            <div class="d-flex gap-1 mb-1">
                                <span class="badge bg-dark bg-opacity-10 text-dark border-0 rounded-pill">{{ $v->panjang_kabel }}</span>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary border-0 rounded-pill">{{ $v->banyak_core }}</span>
                            </div>
                            <div class="text-xs text-muted fw-medium">{{ $v->jenis_kabel }}</div>
                        </td>
                        <td>
                            <div class="text-xs font-monospace">
                                <div class="mb-1"><span class="text-muted">START:</span> {{ $v->start_koordinat }}</div>
                                <div><span class="text-muted">END:</span> {{ $v->end_koordinat }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark small">{{ $v->tehnisi_1 }}</div>
                            @php
                                $others = collect([$v->tehnisi_2, $v->tehnisi_3, $v->tehnisi_4, $v->tehnisi_5])->filter()->count();
                            @endphp
                            @if($others > 0)
                                <span class="badge bg-light text-muted border-0 small">+{{ $others }} Teknisi</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group gap-1">
                                @if(Auth::user()->hasPermission('vendor_edit'))
                                <button type="button" class="btn btn-sm btn-outline-warning border-0 btn-edit-vendor rounded-circle" data-id="{{ $v->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @endif

                                @if(Auth::user()->hasPermission('vendor_delete'))
                                <button type="button" class="btn btn-sm btn-outline-danger border-0 btn-delete-vendor rounded-circle" data-id="{{ $v->id }}" data-name="{{ $v->jenis_kegiatan }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-vendor-{{ $v->id }}" action="{{ route('vendor.destroy', $v->id) }}" method="POST" style="display: none;">
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
                            <i class="fas fa-building fa-3x mb-3 d-block opacity-25"></i>
                            <p class="mb-0">Belum ada data kegiatan vendor.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($vendors->hasPages())
    <div class="card-footer bg-white py-3 border-0">
        {{ $vendors->links() }}
    </div>
    @endif
</div>

@push('modals')
<div class="modal fade" id="vendorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="vendorModalLabel">Data Kegiatan Vendor</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="vendorForm" method="POST">
                @csrf
                <div id="vendorMethodContainer"></div>
                <div class="modal-body p-4">
                    @include('vendor._form')
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5 fw-bold rounded-3" id="btnSaveVendor">Simpan Data</button>
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
        $('#btnCreateVendor').on('click', function() {
            $('#vendorModalLabel').text('Tambah Kegiatan Vendor');
            $('#vendorForm').attr('action', "{{ route('vendor.store') }}");
            $('#vendorMethodContainer').html('');
            $('#vendorForm')[0].reset();
            $('#btnSaveVendor').text('Simpan Data');
            $('#vendorModal').modal('show');
        });

        $(document).on('click', '.btn-edit-vendor', function() {
            let id = $(this).data('id');
            let btn = $(this);
            let originalContent = btn.html();
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ url('vendor') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#vendorModalLabel').text('Edit Kegiatan Vendor');
                    $('#vendorForm').attr('action', "{{ url('vendor') }}/" + id);
                    $('#vendorMethodContainer').html('@method("PUT")');
                    
                    $('#jenis_kegiatan').val(data.jenis_kegiatan);
                    $('#lokasi').val(data.lokasi);
                    $('#start_koordinat').val(data.start_koordinat);
                    $('#end_koordinat').val(data.end_koordinat);
                    $('#panjang_kabel').val(data.panjang_kabel);
                    $('#banyak_core').val(data.banyak_core);
                    $('#jenis_kabel').val(data.jenis_kabel);
                    $('#tehnisi_1').val(data.tehnisi_1);
                    $('#tehnisi_2').val(data.tehnisi_2);
                    $('#tehnisi_3').val(data.tehnisi_3);
                    $('#tehnisi_4').val(data.tehnisi_4);
                    $('#tehnisi_5').val(data.tehnisi_5);
                    
                    $('#btnSaveVendor').text('Perbarui Data');
                    btn.prop('disabled', false).html(originalContent);
                    $('#vendorModal').modal('show');
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalContent);
                    Swal.fire('Error', 'Gagal mengambil data', 'error');
                }
            });
        });

        $(document).on('click', '.btn-delete-vendor', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus Data?',
                text: "Hapus data kegiatan " + name + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-vendor-' + id).submit();
                }
            })
        });
    });
</script>
@endsection
