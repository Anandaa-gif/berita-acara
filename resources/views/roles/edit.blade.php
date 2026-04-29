@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('roles.index') }}" class="btn btn-sm btn-light mb-2"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            <h3 class="fw-bold">Atur Ijin Akses: {{ $role->name }}</h3>
            <p class="text-muted">Centang fitur yang boleh diakses dan dilakukan oleh role ini.</p>
        </div>
    </div>
</div>

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="row">
        @foreach($permissions as $group => $groupPermissions)
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-0">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-layer-group me-2 text-primary"></i> Modul: {{ $group }}</h6>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        @foreach($groupPermissions as $permission)
                        <div class="col-6 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" 
                                       value="{{ $permission->id }}" id="p{{ $permission->id }}"
                                       {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label small" for="p{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card border-0 shadow-sm mt-3">
        <div class="card-body d-flex justify-content-end">
            <a href="{{ route('roles.index') }}" class="btn btn-light px-4 me-2">Batal</a>
            <button type="submit" class="btn btn-primary px-5">Simpan Perubahan Akses</button>
        </div>
    </div>
</form>
@endsection
