@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12 mb-4">
        <h3 class="fw-bold">Edit Berita Acara</h3>
        <p class="text-muted">Perbarui data laporan berita acara di bawah ini.</p>
    </div>
</div>

<div class="container-fluid px-0">
    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 text-primary fw-bold">Edit Berita Acara</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('berita-acara.update', $beritaAcara->id) }}" method="POST" enctype="multipart/form-data" id="baForm">
                        @csrf
                        @method('PUT')
                        
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">I. Data Pelanggan</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Pelanggan</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $beritaAcara->nama) }}" placeholder="Nama Lengkap" required>
                                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. KTP</label>
                                <input type="text" name="no_ktp" class="form-control @error('no_ktp') is-invalid @enderror" value="{{ old('no_ktp', $beritaAcara->no_ktp) }}" placeholder="16 Digit No. KTP" required>
                                @error('no_ktp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $beritaAcara->email) }}" placeholder="email@example.com">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No. HP / WhatsApp</label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $beritaAcara->no_hp) }}" placeholder="0812..." required>
                                @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Alamat Lengkap</label>
                                <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror" placeholder="Jl. Raya No. 123..." required>{{ old('alamat', $beritaAcara->alamat) }}</textarea>
                                @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Link Titik Koordinat (Google Maps)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-map-marker-alt text-danger"></i></span>
                                    <input type="url" name="google_maps_link" class="form-control border-start-0 @error('google_maps_link') is-invalid @enderror" value="{{ old('google_maps_link', $beritaAcara->google_maps_link) }}" placeholder="https://maps.app.goo.gl/...">
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
                                <input type="date" name="tanggal_registrasi" class="form-control @error('tanggal_registrasi') is-invalid @enderror" value="{{ old('tanggal_registrasi', $beritaAcara->tanggal_registrasi) }}" required>
                                @error('tanggal_registrasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Paket Berlangganan</label>
                                <select name="paket_berlangganan" class="form-control @error('paket_berlangganan') is-invalid @enderror" required>
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
                                <input type="text" name="jenis_perangkat" class="form-control @error('jenis_perangkat') is-invalid @enderror" value="{{ old('jenis_perangkat', $beritaAcara->jenis_perangkat) }}" placeholder="Contoh: ONT Huawei HG8245H" required>
                                @error('jenis_perangkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">MAC Address</label>
                                <input type="text" name="mac_address" class="form-control @error('mac_address') is-invalid @enderror" value="{{ old('mac_address', $beritaAcara->mac_address) }}" placeholder="AA:BB:CC:DD:EE:FF">
                                @error('mac_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Serial Number (SN)</label>
                                <input type="text" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', $beritaAcara->serial_number) }}" placeholder="SN1234567890">
                                @error('serial_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Biaya Registrasi (Rp)</label>
                                <select name="biaya_registrasi" class="form-select @error('biaya_registrasi') is-invalid @enderror" required>
                                    <option value="250000" {{ old('biaya_registrasi', round($beritaAcara->biaya_registrasi)) == 250000 ? 'selected' : '' }}>250.000</option>
                                    <option value="150000" {{ old('biaya_registrasi', round($beritaAcara->biaya_registrasi)) == 150000 ? 'selected' : '' }}>150.000</option>
                                </select>
                                @error('biaya_registrasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <hr class="my-4 opacity-50">
                        <h6 class="mb-3 text-muted fw-bold text-uppercase" style="font-size: 0.75rem;">III. Teknisi & Dokumentasi</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Teknisi 1</label>
                                <select name="nama_teknisi_1" class="form-select @error('nama_teknisi_1') is-invalid @enderror" required>
                                    <option value="">Pilih Teknisi 1</option>
                                    @php $techs = ['AMRULLOH SYDIK IBRAHIM', 'SUTIPYO', 'ABDUL WAHED A', 'MAHFUD BAWAFI', 'NOVI TRIWORO', 'FATHOR ROSYID', 'MOH. YUNUS', 'MUHAMMAD HASAN']; @endphp
                                    @foreach($techs as $tech)
                                        <option value="{{ $tech }}" {{ old('nama_teknisi_1', $beritaAcara->nama_teknisi_1) == $tech ? 'selected' : '' }}>{{ $tech }}</option>
                                    @endforeach
                                </select>
                                @error('nama_teknisi_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Teknisi 2</label>
                                <select name="nama_teknisi_2" class="form-select @error('nama_teknisi_2') is-invalid @enderror">
                                    <option value="">Pilih Teknisi 2 (Opsional)</option>
                                    @foreach($techs as $tech)
                                        <option value="{{ $tech }}" {{ old('nama_teknisi_2', $beritaAcara->nama_teknisi_2) == $tech ? 'selected' : '' }}>{{ $tech }}</option>
                                    @endforeach
                                </select>
                                @error('nama_teknisi_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto ODP</label>
                                @if($beritaAcara->foto_odp)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($beritaAcara->foto_odp) }}" alt="ODP" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" name="foto_odp" class="form-control @error('foto_odp') is-invalid @enderror">
                                @error('foto_odp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto Rumah</label>
                                @if($beritaAcara->foto_rumah)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($beritaAcara->foto_rumah) }}" alt="Rumah" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" name="foto_rumah" class="form-control @error('foto_rumah') is-invalid @enderror">
                                @error('foto_rumah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Foto Pelanggan</label>
                                @if($beritaAcara->foto_pelanggan)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($beritaAcara->foto_pelanggan) }}" alt="Pelanggan" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" name="foto_pelanggan" class="form-control @error('foto_pelanggan') is-invalid @enderror">
                                @error('foto_pelanggan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-12 mt-1">
                                <small class="text-muted">Format: JPG, PNG, Max 50MB. Kosongkan jika tidak ingin mengubah.</small>
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
                                <input type="hidden" name="ttd_pelanggan" id="ttd_pelanggan_input" value="{{ $beritaAcara->ttd_pelanggan }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold d-block text-center mb-2">Tanda Tangan Petugas</label>
                                <div class="signature-wrapper border rounded-3 bg-light" style="height: 180px; position: relative;">
                                    <canvas id="ttd_petugas_pad" class="w-100 h-100" style="cursor: crosshair;"></canvas>
                                    <button type="button" class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2" onclick="clearSignature('ttd_petugas_pad')"><i class="fas fa-undo"></i></button>
                                </div>
                                <input type="hidden" name="ttd_petugas" id="ttd_petugas_input" value="{{ $beritaAcara->ttd_petugas }}">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                            <a href="{{ route('berita-acara.index') }}" class="btn btn-light px-4">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold shadow-sm">Perbarui Laporan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Info Column -->
        <div class="col-lg-4">
            <div class="card border-0 bg-info text-white shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-edit fa-2x me-3"></i>
                        <h5 class="fw-bold mb-0">Mode Edit</h5>
                    </div>
                    <p class="mb-0 opacity-75 small">Anda sedang memperbarui data laporan pemasangan baru. Pastikan perubahan sudah benar sebelum disimpan.</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3 text-dark">Data ID</h6>
                    <code class="text-primary small d-block mb-0">{{ $beritaAcara->id }}</code>
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
        
        // Load existing signatures if any (as background or just show image)
        // For simplicity, we just clear and let them re-sign if needed.
        // The hidden input already holds the old value.
        signaturePadPelanggan.clear();
        signaturePadPetugas.clear();
    }

    window.onresize = resizeCanvas;
    resizeCanvas();

    function clearSignature(id) {
        if (id === 'ttd_pelanggan_pad') {
            signaturePadPelanggan.clear();
            document.getElementById('ttd_pelanggan_input').value = '';
        }
        if (id === 'ttd_petugas_pad') {
            signaturePadPetugas.clear();
            document.getElementById('ttd_petugas_input').value = '';
        }
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
