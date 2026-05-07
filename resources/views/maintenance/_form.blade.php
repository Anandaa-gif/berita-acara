<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Jenis Kegiatan</label>
        <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" list="jenisKegiatanOptions" placeholder="Contoh: Perbaikan Kabel / Ganti Modem">
        <datalist id="jenisKegiatanOptions">
            <option value="Perbaikan Kabel">
            <option value="Perbaikan Jaringan">
            <option value="Ganti Modem">
            <option value="Pengecekan Rutin">
            <option value="Relokasi Perangkat">
        </datalist>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Nama Pelanggan</label>
        <input type="text" name="nama_pel" id="nama_pel" class="form-control" placeholder="Contoh: Budi Santoso" required>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Alamat Pelanggan</label>
    <textarea name="alamat_pel" id="alamat_pel" rows="2" class="form-control" placeholder="Jl. Raya No. 123..." required></textarea>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Komplain</label>
        <textarea name="komplain" id="komplain" rows="3" class="form-control" placeholder="Masalah yang dilaporkan..." required></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Action / Tindakan</label>
        <textarea name="action" id="action" rows="3" class="form-control" placeholder="Solusi yang dilakukan..." required></textarea>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Tehnisi 1</label>
        <select name="tehnisi_1" id="tehnisi_1" class="form-select" required>
            <option value="">Pilih Tehnisi 1</option>
            @php $techs = ['AMRULLOH SYDIK IBRAHIM', 'SUTIPYO', 'ABDUL WAHED A', 'MAHFUD BAWAFI', 'NOVI TRIWORO', 'FATHOR ROSYID', 'MOH. YUNUS', 'MUHAMMAD HASAN']; @endphp
            @foreach($techs as $tech)
                <option value="{{ $tech }}">{{ $tech }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Tehnisi 2</label>
        <select name="tehnisi_2" id="tehnisi_2" class="form-select" required>
            <option value="">Pilih Tehnisi 2</option>
            @foreach($techs as $tech)
                <option value="{{ $tech }}">{{ $tech }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Catatan tambahan..." required></textarea>
</div>
