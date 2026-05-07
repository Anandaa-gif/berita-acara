<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Jenis Kegiatan</label>
        <select name="jenis_kegiatan" id="jenis_kegiatan" class="form-select" required onchange="toggleFields()">
            <option value="" selected disabled>-- Pilih Kegiatan --</option>
            <option value="UP ODP">UP ODP/ODC</option>
            <option value="Backbone">Backbone</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Contoh: Jl. Diponegoro" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 field-common">
        <label class="form-label fw-bold">Tiang ODP/ODC</label>
        <input type="text" name="tiang_odp" id="tiang_odp" class="form-control" placeholder="Contoh: ODP-SMG-01">
    </div>
    <div class="col-md-6 field-common">
        <label class="form-label fw-bold">Titik Koordinat</label>
        <input type="text" name="titik_koordinat" id="titik_koordinat" class="form-control" placeholder="0.000, 0.000">
    </div>
    <div class="col-md-12 field-common mt-3">
        <label class="form-label fw-bold">Action</label>
        <input type="text" name="action" id="action" class="form-control" placeholder="Contoh: Perbaikan Patchcore">
    </div>
</div>

<div class="row mb-3 field-up-odp">
    <div class="col-md-6">
        <label class="form-label fw-bold">Ratio</label>
        <input type="text" name="ratio" id="ratio" class="form-control" placeholder="Contoh: 1:8">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Splitter</label>
        <input type="text" name="splitter" id="splitter" class="form-control" placeholder="Contoh: 1/8">
    </div>
</div>

<div class="row mb-3 field-common">
    <div class="col-md-6">
        <label class="form-label fw-bold">Redaman Input</label>
        <input type="text" name="redaman_input" id="redaman_input" class="form-control" placeholder="-18.00">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Redaman Output</label>
        <input type="text" name="redaman_output" id="redaman_output" class="form-control" placeholder="-19.00">
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

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 4 (Optional)</label>
        <input type="text" name="tehnisi_4" id="tehnisi_4" class="form-control form-control-sm">
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 5 (Optional)</label>
        <input type="text" name="tehnisi_5" id="tehnisi_5" class="form-control form-control-sm">
    </div>
</div>

<div class="mb-3">
    <label class="form-label fw-bold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Catatan tambahan..."></textarea>
</div>

<script>
    function toggleFields() {
        var jenis = document.getElementById('jenis_kegiatan').value;
        
        var fieldUpOdp = document.querySelectorAll('.field-up-odp');
        var fieldBackbone = document.querySelectorAll('.field-backbone');
        
        // Hide all conditional fields first
        fieldUpOdp.forEach(function(el) { el.style.display = 'none'; });
        fieldBackbone.forEach(function(el) { el.style.display = 'none'; });
        
        if (jenis === 'UP ODP') {
            fieldUpOdp.forEach(function(el) { 
                el.style.display = el.classList.contains('row') ? 'flex' : 'block'; 
            });
        } else if (jenis === 'Backbone') {
            fieldBackbone.forEach(function(el) { 
                el.style.display = el.classList.contains('row') ? 'flex' : 'block'; 
            });
        }
    }
    
    // Run on load to set initial state
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('jenis_kegiatan').value) {
            toggleFields();
        } else {
            // Default hide conditional fields
            document.querySelectorAll('.field-up-odp').forEach(function(el) { el.style.display = 'none'; });
            document.querySelectorAll('.field-backbone').forEach(function(el) { el.style.display = 'none'; });
        }
    });
</script>
