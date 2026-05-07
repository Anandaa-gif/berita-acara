<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Jenis Kegiatan</label>
        <input type="text" name="jenis_kegiatan" id="jenis_kegiatan" class="form-control" value="{{ isset($backbone) ? $backbone->jenis_kegiatan : old('jenis_kegiatan') }}" list="jenisKegiatanOptions" placeholder="Ketik atau pilih kegiatan" required oninput="toggleFields()">
        <datalist id="jenisKegiatanOptions">
            <option value="UP ODP">
            <option value="Backbone">
        </datalist>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Lokasi</label>
        <input type="text" name="lokasi" id="lokasi" class="form-control" value="{{ isset($backbone) ? $backbone->lokasi : old('lokasi') }}" placeholder="Contoh: Jl. Diponegoro" required>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6 field-common">
        <label class="form-label fw-bold">Tiang ODP/ODC</label>
        <input type="text" name="tiang_odp" id="tiang_odp" class="form-control" value="{{ isset($backbone) ? $backbone->tiang_odp : old('tiang_odp') }}" placeholder="Contoh: ODP-SMG-01">
    </div>
    <div class="col-md-6 field-common">
        <label class="form-label fw-bold">Titik Koordinat</label>
        <input type="text" name="titik_koordinat" id="titik_koordinat" class="form-control" value="{{ isset($backbone) ? $backbone->titik_koordinat : old('titik_koordinat') }}" placeholder="0.000, 0.000">
    </div>
    <div class="col-md-12 field-common mt-3">
        <label class="form-label fw-bold">Action</label>
        <input type="text" name="action" id="action" class="form-control" value="{{ isset($backbone) ? $backbone->action : old('action') }}" placeholder="Contoh: Perbaikan Patchcore">
    </div>
</div>

<div class="row mb-3 field-up-odp">
    <div class="col-md-6">
        <label class="form-label fw-bold">Ratio</label>
        <input type="text" name="ratio" id="ratio" class="form-control" value="{{ isset($backbone) ? $backbone->ratio : old('ratio') }}" placeholder="Contoh: 1:8">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Splitter</label>
        <input type="text" name="splitter" id="splitter" class="form-control" value="{{ isset($backbone) ? $backbone->splitter : old('splitter') }}" placeholder="Contoh: 1/8">
    </div>
</div>

<div class="row mb-3 field-common">
    <div class="col-md-6">
        <label class="form-label fw-bold">Redaman Input</label>
        <input type="text" name="redaman_input" id="redaman_input" class="form-control" value="{{ isset($backbone) ? $backbone->redaman_input : old('redaman_input') }}" placeholder="-18.00">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Redaman Output</label>
        <input type="text" name="redaman_output" id="redaman_output" class="form-control" value="{{ isset($backbone) ? $backbone->redaman_output : old('redaman_output') }}" placeholder="-19.00">
    </div>
</div>

<hr>
<h6 class="fw-bold mb-3">Dokumentasi (Opsional)</h6>
<div class="row mb-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Foto 1</label>
        <input type="file" name="foto_1" id="foto_1" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Foto 2</label>
        <input type="file" name="foto_2" id="foto_2" class="form-control">
    </div>
</div>

<hr>
<h6 class="fw-bold mb-3">Daftar Teknisi</h6>

<div class="row mb-2">
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 1 (Wajib)</label>
        <input type="text" name="tehnisi_1" id="tehnisi_1" class="form-control form-control-sm" value="{{ isset($backbone) ? $backbone->tehnisi_1 : old('tehnisi_1') }}" list="techOptions" required>
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 2 (Optional)</label>
        <input type="text" name="tehnisi_2" id="tehnisi_2" class="form-control form-control-sm" value="{{ isset($backbone) ? $backbone->tehnisi_2 : old('tehnisi_2') }}" list="techOptions">
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 3 (Optional)</label>
        <input type="text" name="tehnisi_3" id="tehnisi_3" class="form-control form-control-sm" value="{{ isset($backbone) ? $backbone->tehnisi_3 : old('tehnisi_3') }}" list="techOptions">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 4 (Optional)</label>
        <input type="text" name="tehnisi_4" id="tehnisi_4" class="form-control form-control-sm" value="{{ isset($backbone) ? $backbone->tehnisi_4 : old('tehnisi_4') }}" list="techOptions">
    </div>
    <div class="col-md-4">
        <label class="form-label text-xs fw-bold">Teknisi 5 (Optional)</label>
        <input type="text" name="tehnisi_5" id="tehnisi_5" class="form-control form-control-sm" value="{{ isset($backbone) ? $backbone->tehnisi_5 : old('tehnisi_5') }}" list="techOptions">
    </div>
</div>

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

<div class="mb-3">
    <label class="form-label fw-bold">Keterangan</label>
    <textarea name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Catatan tambahan...">{{ isset($backbone) ? $backbone->keterangan : old('keterangan') }}</textarea>
</div>

<script>
    function toggleFields() {
        var jenis = document.getElementById('jenis_kegiatan').value.toUpperCase();
        
        var fieldUpOdp = document.querySelectorAll('.field-up-odp');
        var fieldBackbone = document.querySelectorAll('.field-backbone');
        
        // Hide all conditional fields first
        fieldUpOdp.forEach(function(el) { el.style.display = 'none'; });
        fieldBackbone.forEach(function(el) { el.style.display = 'none'; });
        
        if (jenis.includes('UP ODP')) {
            fieldUpOdp.forEach(function(el) { 
                el.style.display = el.classList.contains('row') ? 'flex' : 'block'; 
            });
        } else if (jenis.includes('BACKBONE')) {
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
