<div class="mb-3">
    <label class="form-label fw-bold">Nama Lengkap</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Administrator" required value="{{ old('name') }}">
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Username</label>
        <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" placeholder="admin123" required value="{{ old('username') }}">
        @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">No. HP</label>
        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" placeholder="0812xxxx" required value="{{ old('no_hp') }}">
        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted" id="password_hint"></small>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Role / Hak Akses</label>
        <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $r)
            <option value="{{ $r->id }}" {{ old('role_id') == $r->id ? 'selected' : '' }}>{{ $r->name }}</option>
            @endforeach
        </select>
        @error('role_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

