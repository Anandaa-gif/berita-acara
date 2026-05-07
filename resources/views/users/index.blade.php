@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">Manajemen User</h3>
            <p class="text-muted">Kelola akun administrator dan tehnisi sistem.</p>
        </div>
        <button type="button" class="btn btn-primary" id="btnCreateUser">
            <i class="fas fa-plus me-2"></i> Tambah User
        </button>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">Nama / Username</th>
                        <th>No. HP</th>
                        <th>Role</th>
                        <th>Tanggal Terdaftar</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($u->name) }}&background=4361ee&color=fff" class="rounded-circle me-3" width="40" height="40">
                                <div>
                                    <div class="fw-bold">{{ $u->name }}</div>
                                    <div class="text-muted text-xs">@ {{ $u->username }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $u->no_hp }}</td>
                        <td>
                            @if($u->role && $u->role->slug == 'admin')
                                <span class="badge bg-primary badge-custom">{{ $u->role->name }}</span>
                            @else
                                <span class="badge bg-info text-dark bg-opacity-10 badge-custom">{{ $u->role->name ?? 'No Role' }}</span>
                            @endif
                        </td>
                        <td>{{ $u->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-light text-warning btn-edit-user" data-id="{{ $u->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-light text-danger btn-delete-user" data-id="{{ $u->id }}" data-name="{{ $u->name }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <form id="delete-form-user-{{ $u->id }}" action="{{ route('users.destroy', $u->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3 d-block opacity-25"></i>
                            Belum ada data user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Modal User -->
@push('modals')
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title fw-bold" id="userModalLabel">Form User</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userForm" method="POST">
                @csrf
                <div id="userMethodContainer"></div>
                <div class="modal-body p-4">
                    @include('users._form')
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-5" id="btnSaveUser">Simpan User</button>
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
        // Create Modal
        $('#btnCreateUser').on('click', function() {
            $('#userModalLabel').text('Tambah User Baru');
            $('#userForm').attr('action', "{{ route('users.store') }}");
            $('#userMethodContainer').html('');
            $('#userForm')[0].reset();
            $('#password').prop('required', true);
            $('#password_hint').text('');
            $('#btnSaveUser').text('Simpan User');
            $('#userModal').modal('show');
        });

        // Edit Modal
        $(document).on('click', '.btn-edit-user', function() {
            let id = $(this).data('id');
            let btn = $(this);
            let originalContent = btn.html();
            
            btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: "{{ url('users') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#userModalLabel').text('Edit Akun User');
                    $('#userForm').attr('action', "{{ url('users') }}/" + id);
                    $('#userMethodContainer').html('@method("PUT")');
                    
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#no_hp').val(data.no_hp);
                    $('#role_id').val(data.role_id);
                    
                    $('#password').prop('required', false);
                    $('#password_hint').text('Kosongkan jika tidak ingin mengubah password.');
                    
                    $('#btnSaveUser').text('Perbarui User');
                    btn.prop('disabled', false).html(originalContent);
                    $('#userModal').modal('show');
                },
                error: function(xhr) {
                    btn.prop('disabled', false).html(originalContent);
                    Swal.fire('Error', 'Gagal mengambil data user.', 'error');
                }
            });
        });

        // Delete Handler
        $(document).on('click', '.btn-delete-user', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            
            Swal.fire({
                title: 'Hapus User?',
                text: "Akun " + name + " akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-user-' + id).submit();
                }
            })
        });
        // Reopen modal if validation fails
        @if($errors->any())
            $('#userModal').modal('show');
        @endif
    });
</script>

@endsection
