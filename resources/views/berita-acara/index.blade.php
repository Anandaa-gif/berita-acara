@extends('layouts.admin')

@section('header')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-dark">Data Berita Acara</h3>
            <p class="text-muted mb-0">Manajemen laporan instalasi dan pemasangan baru pelanggan.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-outline-success px-4" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="fas fa-file-excel me-2"></i> Export Excel
            </button>
            <a href="{{ route('berita-acara.create') }}" class="btn btn-primary px-4">
                <i class="fas fa-plus me-2"></i> Tambah Laporan
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="card border-0 shadow-sm overflow-hidden">
    <div class="card-header bg-white py-4 border-0">
        <form action="{{ route('berita-acara.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-0" placeholder="Cari nama, alamat, atau no KTP..." value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light px-4 fw-bold">Cari Data</button>
                @if($search)
                    <a href="{{ route('berita-acara.index') }}" class="btn btn-link text-danger text-decoration-none small">Reset</a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase fw-bold">
                    <tr>
                        <th class="ps-4 py-3" style="width: 50px;">#</th>
                        <th class="py-3">Nama Pelanggan</th>
                        <th>Identitas & Kontak</th>
                        <th>Layanan & Perangkat</th>
                        <th>Tgl Registrasi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($beritaAcaras as $ba)
                    <tr>
                        <td class="ps-4 fw-bold text-muted small">
                            {{ ($beritaAcaras->currentPage() - 1) * $beritaAcaras->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $ba->nama }}</div>
                            <small class="text-muted d-block text-truncate" style="max-width: 200px;">{{ $ba->alamat }}</small>
                        </td>
                        <td>
                            <div class="text-dark fw-medium small">{{ $ba->no_ktp }}</div>
                            <div class="text-primary small fw-bold">{{ $ba->no_hp }}</div>
                        </td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary mb-1 rounded-pill">{{ $ba->paket_berlangganan }}</span>
                            <div class="text-muted small"><i class="fas fa-microchip me-1"></i> {{ $ba->jenis_perangkat }}</div>
                        </td>
                        <td>
                            <div class="text-dark fw-medium">{{ \Carbon\Carbon::parse($ba->tanggal_registrasi)->format('d/m/Y') }}</div>
                            <small class="text-muted small">Oleh: {{ $ba->user->name ?? 'System' }}</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm rounded-pill px-3 shadow-none border" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-h text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2" style="border-radius: 16px; min-width: 210px;">
                                    <div class="px-3 py-2 mb-1 border-bottom">
                                        <p class="text-uppercase text-muted fw-bold mb-0" style="font-size: 0.65rem; letter-spacing: 1px;">Opsi Laporan</p>
                                    </div>
                                    <a class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1" href="{{ route('berita-acara.show', $ba->id) }}">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-eye small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Lihat Detail</span>
                                    </a>
                                    
                                    <a class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1" href="{{ route('berita-acara.download-pdf', $ba->id) }}">
                                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-file-pdf small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Cetak PDF</span>
                                    </a>

                                    @if(Auth::user()->hasPermission('berita_acara_edit'))
                                    <a class="dropdown-item d-flex align-items-center rounded-3 py-2 mb-1" href="{{ route('berita-acara.edit', $ba->id) }}">
                                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-edit small"></i>
                                        </div>
                                        <span class="fw-semibold small text-dark">Edit Laporan</span>
                                    </a>
                                    @endif

                                    @if(Auth::user()->hasPermission('berita_acara_delete'))
                                    <div class="border-top my-1 opacity-50"></div>
                                    <button type="button" class="dropdown-item d-flex align-items-center rounded-3 py-2 text-danger btn-delete-ba" data-id="{{ $ba->id }}" data-name="{{ $ba->nama }}">
                                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px;">
                                            <i class="fas fa-trash-alt small"></i>
                                        </div>
                                        <span class="fw-bold small">Hapus Laporan</span>
                                    </button>
                                    <form id="delete-form-ba-{{ $ba->id }}" action="{{ route('berita-acara.destroy', $ba->id) }}" method="POST" style="display: none;">
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
                        <td colspan="5" class="text-center py-5 text-muted">
                            <img src="https://illustrations.popsy.co/blue/searching.svg" alt="Empty" style="width: 180px;" class="mb-3 opacity-75">
                            <p class="mb-0">Tidak ada data berita acara ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($beritaAcaras->hasPages())
    <div class="card-footer bg-white py-3 border-0">
        {{ $beritaAcaras->links() }}
    </div>
    @endif
</div>

@push('modals')
    <!-- Modal Export -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-bold text-dark">Export ke Excel</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('berita-acara.export-excel') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">Pilih rentang tanggal registrasi untuk mengekspor data laporan ke format Excel (.xlsx).</p>
                        <div class="row g-3">
                            <div class="col-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Dari Tanggal</label>
                                <input type="date" name="start_date" class="form-control rounded-3" value="{{ date('Y-m-01') }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-bold small text-muted text-uppercase">Sampai Tanggal</label>
                                <input type="date" name="end_date" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="button" class="btn btn-light px-4 rounded-3" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4 fw-bold rounded-3">Mulai Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@endsection

@section('scripts')
<script>
    $(document).on('click', '.btn-delete-ba', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        
        Swal.fire({
            title: 'Hapus Data?',
            text: "Anda akan menghapus data " + name + ". Tindakan ini permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-ba-' + id).submit();
            }
        })
    });
</script>
@endsection
