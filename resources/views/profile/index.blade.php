@extends('layouts.admin')

@section('header')
<div class="d-flex align-items-center">
    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
        <i class="fas fa-user-cog fa-2x"></i>
    </div>
    <div>
        <h3 class="fw-bold mb-0 text-dark">Profil Pengguna</h3>
        <p class="text-muted mb-0">Kelola informasi akun dan kata sandi Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="row g-4">
    <!-- Profile Info -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4 px-4">
                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-id-card me-2 text-primary"></i> Informasi Akun</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-12 text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4361ee&color=fff&bold=true&size=128" 
                                     class="rounded-circle shadow-sm border border-4 border-white" 
                                     width="120" height="120">
                                <div class="position-absolute bottom-0 end-0">
                                    <span class="badge bg-success rounded-circle p-2 border border-2 border-white">
                                        <i class="fas fa-check small"></i>
                                    </span>
                                </div>
                            </div>
                            <h4 class="fw-bold mt-3 mb-0">{{ $user->name }}</h4>
                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill mt-2">
                                <i class="fas fa-shield-alt me-1"></i> {{ $user->role->name ?? 'User' }}
                            </span>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-0 @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $user->name) }}" required>
                            </div>
                            @error('name') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">Username</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-at text-muted"></i></span>
                                <input type="text" name="username" class="form-control bg-light border-0 @error('username') is-invalid @enderror" 
                                       value="{{ old('username', $user->username) }}" required>
                            </div>
                            @error('username') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small text-uppercase">Nomor HP</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-muted"></i></span>
                                <input type="text" name="no_hp" class="form-control bg-light border-0 @error('no_hp') is-invalid @enderror" 
                                       value="{{ old('no_hp', $user->no_hp) }}" required>
                            </div>
                            @error('no_hp') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12 mt-4 pt-3 border-top">
                            <button type="submit" class="btn btn-primary px-5 fw-bold rounded-3 shadow-sm">
                                <i class="fas fa-save me-2"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Password Management -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm mb-4" style="border-radius: 20px;">
            <div class="card-header bg-white border-0 py-4 px-4">
                <h5 class="mb-0 fw-bold text-dark"><i class="fas fa-lock me-2 text-warning"></i> Keamanan</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">Kata Sandi Saat Ini</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-key text-muted"></i></span>
                                <input type="password" name="current_password" class="form-control bg-light border-0 @error('current_password', 'updatePassword') is-invalid @enderror" required>
                            </div>
                            @error('current_password', 'updatePassword') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">Kata Sandi Baru</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-0 @error('password', 'updatePassword') is-invalid @enderror" required>
                            </div>
                            @error('password', 'updatePassword') <div class="invalid-feedback d-block small">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small text-uppercase">Konfirmasi Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="fas fa-check-double text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control bg-light border-0" required>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-warning px-5 fw-bold text-white rounded-3 shadow-sm w-100">
                                <i class="fas fa-shield-alt me-2"></i> Perbarui Kata Sandi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Card -->
        <div class="card border-0 shadow-sm bg-primary text-white" style="border-radius: 20px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-info-circle fa-2x me-3 opacity-50"></i>
                    <h5 class="fw-bold mb-0">Tips Keamanan</h5>
                </div>
                <p class="small mb-0 opacity-75">
                    Gunakan kombinasi huruf besar, kecil, angka, dan simbol untuk kata sandi yang lebih kuat. Jangan berikan kredensial Anda kepada siapapun.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
