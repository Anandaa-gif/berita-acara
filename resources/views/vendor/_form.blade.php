<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Jenis Kegiatan</label>
        <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-select" required onchange="toggleFields()">
            <option value="" selected disabled>-- Pilih Jenis Kegiatan --</option>
            <option value="Penyambungan Kabel">Penyambungan Kabel</option>
            <option value="Up ODP">Up ODP</option>
            <option value="Penarikan Kabel">Penarikan Kabel</option>
            <option value="Penanaman Tiang">Penanaman Tiang</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Contoh: Banteng Mati" required>
    </div>
</div>

<div class="row mb-3" id="section_action">
    <div class="col-md-12">
        <label class="form-label fw-bold">Action</label>
        <input type="text" name="action" id="action" class="form-control" placeholder="Action yang dilakukan">
    </div>
</div>

<!-- Section: Single Koordinat (Used for Penyambungan, Up ODP, Penanaman Tiang) -->
<div id="section_koordinat_single" style="display: none;">
    <div class="row mb-3">
        <div class="col-md-12">
            <label class="form-label fw-bold">Koordinat</label>
            <input type="text" name="koordinat" id="koordinat" class="form-control" placeholder="0.000, 0.000">
        </div>
    </div>
</div>

<!-- Section: Multi Koordinat (Used for Penarikan Kabel) -->
<div id="section_koordinat_multi" style="display: none;">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Start Koordinat</label>
            <input type="text" name="start_koordinat" id="start_koordinat" class="form-control" placeholder="0.000, 0.000">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">End Koordinat</label>
            <input type="text" name="end_koordinat" id="end_koordinat" class="form-control" placeholder="0.000, 0.000">
        </div>
    </div>
</div>

<!-- Section: Kabel Details (Used for Penarikan Kabel) -->
<div id="section_kabel_details" style="display: none;">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Banyak Core</label>
            <input type="text" name="banyak_core" id="banyak_core" class="form-control" placeholder="Contoh: 12 Core">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Jenis Kabel</label>
            <input type="text" name="jenis_kabel" id="jenis_kabel" class="form-control" placeholder="Contoh: ADSS">
        </div>
    </div>
</div>

<!-- Section: Panjang Kabel (Used for Penyambungan & Penarikan) -->
<div id="section_panjang_kabel" style="display: none;">
    <div class="row mb-3">
        <div class="col-md-12">
            <label class="form-label fw-bold">Panjang Kabel (m) <span id="panjang_label_optional" class="text-muted fw-normal">(Optional)</span></label>
            <input type="text" name="panjang_kabel" id="panjang_kabel" class="form-control" placeholder="Contoh: 100m">
        </div>
    </div>
</div>

<!-- Section: Up ODP Details -->
<div id="section_odp" style="display: none;">
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Spliter</label>
            <input type="text" name="spliter" id="spliter" class="form-control" placeholder="Contoh: 1/8">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Ratio</label>
            <input type="text" name="ratio" id="ratio" class="form-control" placeholder="Contoh: 1:8">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label class="form-label fw-bold">Redaman Input</label>
            <input type="text" name="redaman_input" id="redaman_input" class="form-control" placeholder="-18.00">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Redaman Output</label>
            <input type="text" name="redaman_output" id="redaman_output" class="form-control" placeholder="-19.00">
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-12">
        <label class="form-label fw-bold">Keterangan</label>
        <textarea name="keterangan" id="keterangan" class="form-control" rows="2" placeholder="Catatan tambahan..."></textarea>
    </div>
</div>

<hr>
<h6 class="fw-bold mb-3">Daftar Teknisi</h6>

<div class="row mb-2">
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 1 (Wajib)</label>
        <input type="text" name="tehnisi_1" id="tehnisi_1" class="form-control form-control-sm" required>
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 2 (Optional)</label>
        <input type="text" name="tehnisi_2" id="tehnisi_2" class="form-control form-control-sm">
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 3 (Optional)</label>
        <input type="text" name="tehnisi_3" id="tehnisi_3" class="form-control form-control-sm">
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 4 (Optional)</label>
        <input type="text" name="tehnisi_4" id="tehnisi_4" class="form-control form-control-sm">
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 5 (Optional)</label>
        <input type="text" name="tehnisi_5" id="tehnisi_5" class="form-control form-control-sm">
    </div>
</div>

<script>
function toggleFields() {
    const jenis = document.getElementById('jenis_kegiatan').value;
    const sectionAction = document.getElementById('section_action');
    const sectionOdp = document.getElementById('section_odp');
    const sectionKoordinatSingle = document.getElementById('section_koordinat_single');
    const sectionKoordinatMulti = document.getElementById('section_koordinat_multi');
    const sectionKabelDetails = document.getElementById('section_kabel_details');
    const sectionPanjangKabel = document.getElementById('section_panjang_kabel');
    const panjangLabelOptional = document.getElementById('panjang_label_optional');

    // Reset visibility
    sectionAction.style.display = 'block';
    sectionOdp.style.display = 'none';
    sectionKoordinatSingle.style.display = 'none';
    sectionKoordinatMulti.style.display = 'none';
    sectionKabelDetails.style.display = 'none';
    sectionPanjangKabel.style.display = 'none';
    panjangLabelOptional.style.display = 'none';

    // Set visibility based on selection
    if (jenis === 'Penyambungan Kabel') {
        sectionAction.style.display = 'none'; // Hide action based on user request list
        sectionKoordinatSingle.style.display = 'block';
        sectionPanjangKabel.style.display = 'block';
        panjangLabelOptional.style.display = 'inline';
    } else if (jenis === 'Penarikan Kabel') {
        sectionKoordinatMulti.style.display = 'block';
        sectionKabelDetails.style.display = 'block';
        sectionPanjangKabel.style.display = 'block';
        panjangLabelOptional.style.display = 'none'; // Maybe mandatory for penarikan? User didn't say, but optional for penyambungan
    } else if (jenis === 'Up ODP') {
        sectionOdp.style.display = 'block';
        sectionKoordinatSingle.style.display = 'block';
    } else if (jenis === 'Penanaman Tiang') {
        sectionKoordinatSingle.style.display = 'block';
    }
}

// Trigger on load if there's an existing value (for edit)
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('jenis_kegiatan').value) {
        toggleFields();
    }
});
</script>
