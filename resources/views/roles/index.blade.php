@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Manajemen Role & Akses</h3>
            <p class="text-muted">Kelola peran pengguna dan ijin akses fitur sistem.</p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
            <i class="fas fa-plus me-2"></i> Tambah Role
        </button>
    </div>
</div>

<div class="row">
    @foreach($roles as $role)
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">{{ $role->name }}</h5>
                        <span class="badge bg-light text-dark border">{{ $role->slug }}</span>
                    </div>
                    <div class="p-2 bg-primary bg-opacity-10 rounded text-primary">
                        <i class="fas fa-user-shield"></i>
                    </div>
                </div>
                <p class="text-muted small">Digunakan oleh <strong>{{ $role->users_count }}</strong> pengguna.</p>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    @if($role->slug !== 'admin')
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-key me-1"></i> Atur Ijin
                    </a>
                    @else
                    <span class="badge bg-success bg-opacity-10 text-success"><i class="fas fa-check-double me-1"></i> Full Access</span>
                    @endif

                    @if($role->slug !== 'admin' && $role->slug !== 'teknisi')
                    <button type="button" class="btn btn-sm btn-light text-danger btn-delete-role" data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <form id="delete-form-role-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@push('modals')
<!-- Modal Create Role -->
<div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold">Tambah Role Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Role</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Manager Operasional" required value="{{ old('name') }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5">Simpan Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endpush

@endsection

@section('scripts')
<script>
    $(document).on('click', '.btn-delete-role', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');
        
        Swal.fire({
            title: 'Hapus Role?',
            text: "Role " + name + " akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#delete-form-role-' + id).submit();
            }
        });
    });

    // Reopen modal if validation fails
    @if($errors->any())
        $('#createRoleModal').modal('show');
    @endif

</script>
@endsection
