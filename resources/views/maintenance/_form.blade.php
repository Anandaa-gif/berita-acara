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
        <input type="text" name="tehnisi_1" id="tehnisi_1" class="form-control" value="{{ isset($maintenance) ? $maintenance->tehnisi_1 : old('tehnisi_1') }}" list="techOptions" placeholder="Ketik atau pilih teknisi" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Tehnisi 2</label>
        <input type="text" name="tehnisi_2" id="tehnisi_2" class="form-control" value="{{ isset($maintenance) ? $maintenance->tehnisi_2 : old('tehnisi_2') }}" list="techOptions" placeholder="Ketik atau pilih teknisi (opsional)">
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
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Catatan tambahan..." required></textarea>
</div>
