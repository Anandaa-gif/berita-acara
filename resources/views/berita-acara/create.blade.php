@extends('layouts.admin')

@section('content')
<div class="container-fluid px-0">
    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-primary fw-bold">Form Pemasangan Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('berita-acara.store') }}" method="POST" enctype="multipart/form-data" id="baForm">
                        @csrf
                        
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">I. Data Pelanggan</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Pelanggan</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Lengkap" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. KTP</label>
                                <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" value="{{ old('no_ktp') }}" placeholder="16 Digit No. KTP" required>
                                @error('no_ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@example.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="0812..." required>
                                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror" placeholder="Jl. Raya No. 123..." required>{{ old('alamat') }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Link Titik Koordinat (Google Maps)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                    <input type="url" name="google_maps_link" class="form-control border-start-0 @error('google_maps_link') is-invalid @enderror" value="{{ old('google_maps_link') }}" placeholder="https://maps.app.goo.gl/...">
                                </div>
                                <small class="text-muted">Opsional: Masukkan link dari Google Maps untuk memudahkan pencarian lokasi.</small>
                                @error('google_maps_link') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">II. Detail Layanan</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Registrasi</label>
                                <input type="date" name="tanggal_registrasi" class="form-control @error('tanggal_registrasi') is-invalid @enderror" value="{{ old('tanggal_registrasi', date('Y-m-d')) }}" required>
                                @error('tanggal_registrasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Paket Berlangganan</label>
                                <select name="paket_berlangganan" class="form-control @error('paket_berlangganan') is-invalid @enderror" required>
                                    <option value="">Pilih Paket</option>
                                    <option value="10 Mbps" {{ old('paket_berlangganan') == '10 Mbps' ? 'selected' : '' }}>10 Mbps</option>
                                    <option value="20 Mbps" {{ old('paket_berlangganan') == '20 Mbps' ? 'selected' : '' }}>20 Mbps</option>
                                    <option value="30 Mbps" {{ old('paket_berlangganan') == '30 Mbps' ? 'selected' : '' }}>30 Mbps</option>
                                    <option value="50 Mbps" {{ old('paket_berlangganan') == '50 Mbps' ? 'selected' : '' }}>50 Mbps</option>
                                    <option value="75 Mbps" {{ old('paket_berlangganan') == '75 Mbps' ? 'selected' : '' }}>75 Mbps</option>
                                    <option value="100 Mbps" {{ old('paket_berlangganan') == '100 Mbps' ? 'selected' : '' }}>100 Mbps</option>
                                </select>
                                @error('paket_berlangganan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Perangkat</label>
                                <input type="text" name="jenis_perangkat" class="form-control @error('jenis_perangkat') is-invalid @enderror" value="{{ old('jenis_perangkat') }}" placeholder="Contoh: ONT Huawei HG8245H" required>
                                @error('jenis_perangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">MAC Address</label>
                                <input type="text" name="mac_address" class="form-control @error('mac_address') is-invalid @enderror" value="{{ old('mac_address') }}" placeholder="AA:BB:CC:DD:EE:FF">
                                @error('mac_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Serial Number (SN)</label>
                                <input type="text" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}" placeholder="SN1234567890">
                                @error('serial_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Biaya Registrasi (Rp)</label>
                                <select name="biaya_registrasi" class="form-select @error('biaya_registrasi') is-invalid @enderror" required>
                                    <option value="">Pilih Biaya</option>
                                    <option value="250000" {{ old('biaya_registrasi') == '250000' ? 'selected' : '' }}>250.000</option>
                                    <option value="150000" {{ old('biaya_registrasi') == '150000' ? 'selected' : '' }}>150.000</option>
                                </select>
                                @error('biaya_registrasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">III. Teknisi & Dokumentasi</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Teknisi 1</label>
                                <input type="text" name="nama_teknisi_1" class="form-control @error('nama_teknisi_1') is-invalid @enderror" value="{{ old('nama_teknisi_1') }}" list="techOptions" placeholder="Ketik atau pilih teknisi" required>
                                @error('nama_teknisi_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Teknisi 2</label>
                                <input type="text" name="nama_teknisi_2" class="form-control @error('nama_teknisi_2') is-invalid @enderror" value="{{ old('nama_teknisi_2') }}" list="techOptions" placeholder="Ketik atau pilih teknisi (opsional)">
                                <datalist id="techOptions">
                                    <option value="AMRULLOH SYDIK IBRAHIM">
                                    <option value="SUTIPYO">
                                    <option value="ABDUL WAHED A">
                                    <option value="MAHFUD BAWAFI">
                                    <option value="NOVI TRIWORO">
                                    <option value="FATHOR ROSYID">
                                    <option value="MOH. YUNUS">
                                    <option value="MUHAMMAD HASAN">
                                </datalist>
                                @error('nama_teknisi_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto ODP</label>
                                <input type="file" name="foto_odp" class="form-control @error('foto_odp') is-invalid @enderror">
                                @error('foto_odp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto Rumah</label>
                                <input type="file" name="foto_rumah" class="form-control @error('foto_rumah') is-invalid @enderror">
                                @error('foto_rumah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto Pelanggan</label>
                                <input type="file" name="foto_pelanggan" class="form-control @error('foto_pelanggan') is-invalid @enderror">
                                @error('foto_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <small class="text-muted">Format: JPG, PNG, Max 50MB per file.</small>
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">IV. Tanda Tangan</h6>
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block text-center mb-2">Tanda Tangan Pelanggan</label>
                                <div class="signature-wrapper border rounded-3 bg-light" style="height: 180px; position: relative;">
                                    <canvas id="ttd_pelanggan_pad" class="w-100 h-100" style="cursor: crosshair;"></canvas>
                                    <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2" onclick="clearSignature('ttd_pelanggan_pad')"><i class="fas fa-undo"></i></button>
                                </div>
                                <input type="hidden" name="ttd_pelanggan" id="ttd_pelanggan_input">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block text-center mb-2">Tanda Tangan Petugas</label>
                                <div class="signature-wrapper border rounded-3 bg-light" style="height: 180px; position: relative;">
                                    <canvas id="ttd_petugas_pad" class="w-100 h-100" style="cursor: crosshair;"></canvas>
                                    <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2" onclick="clearSignature('ttd_petugas_pad')"><i class="fas fa-undo"></i></button>
                                </div>
                                <input type="hidden" name="ttd_petugas" id="ttd_petugas_input">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('berita-acara.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Simpan Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info Column -->
        <div class="col-lg-4">
            <div class="card border-0 bg-primary text-white shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-info-circle fa-2x me-3"></i>
                        <h5 class="fw-bold mb-0">Informasi Penting</h5>
                    </div>
                    <p class="mb-3 opacity-75 small">Mohon periksa kembali seluruh data yang telah diinput sebelum menekan tombol simpan.</p>
                    <ul class="list-unstyled mb-0 small">
                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Pastikan No. HP aktif untuk WhatsApp.</li>
                        <li class="mb-2"><i class="fas fa-check-circle me-2"></i> Foto dokumentasi harus jelas.</li>
                        <li><i class="fas fa-check-circle me-2"></i> Tanda tangan tidak boleh kosong.</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 text-dark">Panduan Input</h6>
                    <p class="text-muted small mb-0">Jika terjadi kesalahan input, Anda dapat mereset tanda tangan menggunakan tombol merah di pojok kanan atas kotak tanda tangan.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
    const canvasPelanggan = document.getElementById('ttd_pelanggan_pad');
    const canvasPetugas = document.getElementById('ttd_petugas_pad');
    
    const signaturePadPelanggan = new SignaturePad(canvasPelanggan);
    const signaturePadPetugas = new SignaturePad(canvasPetugas);

    // Resize canvas
    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        [canvasPelanggan, canvasPetugas].forEach(canvas => {
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        });
        signaturePadPelanggan.clear();
        signaturePadPetugas.clear();
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    function clearSignature(id) {
        if (id === 'ttd_pelanggan_pad') signaturePadPelanggan.clear();
        if (id === 'ttd_petugas_pad') signaturePadPetugas.clear();
    }

    document.getElementById('baForm').onsubmit = function() {
        if (!signaturePadPelanggan.isEmpty()) {
            document.getElementById('ttd_pelanggan_input').value = signaturePadPelanggan.toDataURL();
        }
        if (!signaturePadPetugas.isEmpty()) {
            document.getElementById('ttd_petugas_input').value = signaturePadPetugas.toDataURL();
        }
    };
</script>
@endsection
