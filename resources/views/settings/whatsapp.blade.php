@extends('layouts.admin')

@section('header')
    <div class="mb-3">
        <h3 class="fw-bold text-dark mb-0">Pengaturan API (WhatsApp & Telegram)</h3>
    </div>
@endsection

@section('content')
<div class="row g-4 pb-5">
    <!-- Left Column: Telegram -->
    <div class="col-lg-6">
        <div class="flip-card-container">
            <div class="flip-card-inner" id="telegram-card">
                <!-- Front Side -->
                <div class="flip-card-front">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="p-3 text-white" style="background: linear-gradient(135deg, #0088cc 0%, #00a2ed 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-telegram fa-lg me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-0">Telegram Gateway</h5>
                            <p class="mb-0 opacity-75 x-small">Konfigurasi multi-bot real-time</p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link p-0 border-0 shadow-none text-white text-decoration-none" onclick="document.getElementById('telegram-card').classList.toggle('flipped')" title="Lihat Riwayat Pesan">
                        <i class="fas fa-arrow-right fa-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="accordion accordion-custom" id="telegramAccordion">
                    <!-- Berita Acara -->
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button rounded-4 fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBeritaAcara">
                                <span class="icon-box me-3 bg-success-light text-success"><i class="fas fa-file-signature"></i></span>
                                Modul Berita Acara
                            </button>
                        </h2>
                        <div id="collapseBeritaAcara" class="accordion-collapse collapse show" data-bs-parent="#telegramAccordion">
                            <div class="accordion-body p-4 pt-0">
                                <div class="mb-3">
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Bot Token</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-robot"></i></span>
                                        <input type="password" name="telegram_bot_token" class="form-control" placeholder="Enter bot token" value="{{ $settings['telegram_bot_token'] }}">
                                        <button class="btn btn-link text-muted" type="button" onclick="toggleTokenVisibility(this)"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Chat / Group ID</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        <input type="text" name="telegram_chat_id" class="form-control" placeholder="Contoh: -100xxxxxxxx" value="{{ $settings['telegram_chat_id'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance -->
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMaintenance">
                                <span class="icon-box me-3 bg-primary-light text-primary"><i class="fas fa-tools"></i></span>
                                Modul Maintenance
                            </button>
                        </h2>
                        <div id="collapseMaintenance" class="accordion-collapse collapse" data-bs-parent="#telegramAccordion">
                            <div class="accordion-body p-4 pt-0">
                                <div class="mb-3">
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Bot Token</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-robot"></i></span>
                                        <input type="password" name="telegram_maintenance_token" class="form-control" placeholder="Enter bot token" value="{{ $settings['telegram_maintenance_token'] }}">
                                        <button class="btn btn-link text-muted" type="button" onclick="toggleTokenVisibility(this)"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Chat / Group ID</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        <input type="text" name="telegram_maintenance_chat_id" class="form-control" placeholder="Contoh: -100xxxxxxxx" value="{{ $settings['telegram_maintenance_chat_id'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vendor -->
                    <div class="accordion-item mb-3 border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVendor">
                                <span class="icon-box me-3 bg-info-light text-info"><i class="fas fa-building"></i></span>
                                Modul Vendor
                            </button>
                        </h2>
                        <div id="collapseVendor" class="accordion-collapse collapse" data-bs-parent="#telegramAccordion">
                            <div class="accordion-body p-4 pt-0">
                                <div class="mb-3">
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Bot Token</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-robot"></i></span>
                                        <input type="password" name="telegram_vendor_token" class="form-control" placeholder="Enter bot token" value="{{ $settings['telegram_vendor_token'] }}">
                                        <button class="btn btn-link text-muted" type="button" onclick="toggleTokenVisibility(this)"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Chat / Group ID</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        <input type="text" name="telegram_vendor_chat_id" class="form-control" placeholder="Contoh: -100xxxxxxxx" value="{{ $settings['telegram_vendor_chat_id'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Backbone -->
                    <div class="accordion-item border-0 shadow-sm">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed rounded-4 fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBackbone">
                                <span class="icon-box me-3 bg-warning-light text-warning"><i class="fas fa-network-wired"></i></span>
                                Modul Backbone
                            </button>
                        </h2>
                        <div id="collapseBackbone" class="accordion-collapse collapse" data-bs-parent="#telegramAccordion">
                            <div class="accordion-body p-4 pt-0">
                                <div class="mb-3">
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Bot Token</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-robot"></i></span>
                                        <input type="password" name="telegram_backbone_token" class="form-control" placeholder="Enter bot token" value="{{ $settings['telegram_backbone_token'] }}">
                                        <button class="btn btn-link text-muted" type="button" onclick="toggleTokenVisibility(this)"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label text-uppercase text-muted fw-bold x-small">Chat / Group ID</label>
                                    <div class="input-group modern-input-group">
                                        <span class="input-group-text"><i class="fas fa-users"></i></span>
                                        <input type="text" name="telegram_backbone_chat_id" class="form-control" placeholder="Contoh: -100xxxxxxxx" value="{{ $settings['telegram_backbone_chat_id'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Back Side -->
        <div class="flip-card-back">
                <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white" style="border-radius: 20px;">
                    <div class="p-3 text-white" style="background: linear-gradient(135deg, #00a2ed 0%, #0088cc 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0"><i class="fas fa-history me-2"></i> Riwayat Telegram</h5>
                            <button type="button" class="btn btn-link p-0 border-0 shadow-none text-white text-decoration-none" onclick="document.getElementById('telegram-card').classList.toggle('flipped')" title="Kembali ke Pengaturan">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 overflow-auto" style="height: calc(100% - 60px);">
                        <ul class="list-group list-group-flush">
                            @forelse($telegramLogs as $log)
                                <li class="list-group-item p-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge {{ $log->status == 'success' ? 'bg-success' : 'bg-danger' }}">
                                            {{ strtoupper($log->status) }}
                                        </span>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i>{{ $log->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="fw-bold small mb-1 text-dark"><i class="fas fa-paper-plane me-1 text-muted"></i> {{ $log->target }}</div>
                                    <div class="small text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $log->message }}</div>
                                    @if($log->status == 'failed')
                                        <div class="small text-danger mt-1 fst-italic">{{ $log->response }}</div>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-center p-5 text-muted">
                                    <i class="fas fa-comment-slash fa-3x mb-3 opacity-25"></i>
                                    <p>Belum ada riwayat pesan Telegram.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Right Column: WhatsApp -->
    <div class="col-lg-6">
        <div class="flip-card-container">
            <div class="flip-card-inner" id="whatsapp-card">
                <!-- Front Side -->
                <div class="flip-card-front">
                    <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white" style="border-radius: 20px;">
                        <div class="p-3 text-white" style="background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fab fa-whatsapp fa-lg me-3"></i>
                        <div>
                            <h5 class="fw-bold mb-0">WhatsApp Gateway</h5>
                            <p class="mb-0 opacity-75 x-small">Integrasi Fonnte API</p>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link p-0 border-0 shadow-none text-white text-decoration-none" onclick="document.getElementById('whatsapp-card').classList.toggle('flipped')" title="Lihat Riwayat Pesan">
                        <i class="fas fa-arrow-right fa-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <label class="form-label text-uppercase text-muted fw-bold x-small">Vendor</label>
                        <select name="wa_vendor" class="form-select modern-select">
                            <option value="FONNTE">FONNTE API</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label text-uppercase text-muted fw-bold x-small">Delay (Seconds)</label>
                        <div class="input-group modern-input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="number" name="wa_delay" class="form-control" value="{{ $settings['wa_delay'] }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase text-muted fw-bold x-small">API Token Fonnte</label>
                        <div class="input-group modern-input-group">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="wa_token" class="form-control" placeholder="Enter Fonnte token" value="{{ $settings['wa_token'] }}">
                            <button class="btn btn-link text-muted" type="button" onclick="toggleTokenVisibility(this)"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-uppercase text-muted fw-bold x-small">Nomor Uji Coba</label>
                        <div class="input-group modern-input-group">
                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" name="wa_notify_number" class="form-control" placeholder="Contoh: 08123456789" value="{{ $settings['wa_notify_number'] }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="feature-toggle p-3 rounded-4 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="feature-icon bg-success bg-opacity-10 text-success me-3">
                                    <i class="fas fa-file-pdf"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 small">Kirim PDF Otomatis</h6>
                                    <p class="text-muted mb-0 x-small">Lampirkan file Berita Acara ke pelanggan</p>
                                </div>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input" type="checkbox" name="wa_send_pdf" id="wa_send_pdf" value="1" {{ $settings['wa_send_pdf'] == '1' ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Dynamic UI Card for Status -->
                    <div class="col-12 mt-auto">
                        @if($fonnteStatus === 'active')
                            <div class="alert alert-soft-success border-0 rounded-4 d-flex align-items-center mb-0 p-3">
                                <div class="pulse-container me-3">
                                    <div class="pulse-dot bg-success"></div>
                                </div>
                                <span class="small fw-bold text-success">Status: Fonnte Terhubung & Siap Digunakan</span>
                            </div>
                        @elseif($fonnteStatus === 'inactive')
                            <div class="alert border-0 rounded-4 d-flex align-items-center mb-0 p-3" style="background-color: #fff3cd;">
                                <div class="pulse-container me-3">
                                    <div class="pulse-dot bg-warning" style="animation: none;"></div>
                                </div>
                                <span class="small fw-bold" style="color: #856404 !important;">Status: WhatsApp Disconnect / Token Invalid</span>
                            </div>
                        @elseif($fonnteStatus === 'error')
                            <div class="alert alert-soft-danger border-0 rounded-4 d-flex align-items-center mb-0 p-3" style="background-color: #fceceb;">
                                <div class="pulse-container me-3">
                                    <div class="pulse-dot bg-danger" style="animation: none;"></div>
                                </div>
                                <span class="small fw-bold text-danger">Status: Gagal Terhubung ke Server Fonnte</span>
                            </div>
                        @else
                            <div class="alert alert-soft-danger border-0 rounded-4 d-flex align-items-center mb-0 p-3" style="background-color: #fceceb;">
                                <div class="pulse-container me-3">
                                    <div class="pulse-dot bg-danger" style="animation: none;"></div>
                                </div>
                                <span class="small fw-bold text-danger">Status: Token Kosong (Gateway Tidak Aktif)</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Back Side -->
        <div class="flip-card-back">
                <div class="card border-0 shadow-sm h-100 overflow-hidden bg-white" style="border-radius: 20px;">
                    <div class="p-3 text-white" style="background: linear-gradient(135deg, #128c7e 0%, #25d366 100%);">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0"><i class="fas fa-history me-2"></i> Riwayat WhatsApp</h5>
                            <button type="button" class="btn btn-link p-0 border-0 shadow-none text-white text-decoration-none" onclick="document.getElementById('whatsapp-card').classList.toggle('flipped')" title="Kembali ke Pengaturan">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0 overflow-auto" style="height: calc(100% - 60px);">
                        <ul class="list-group list-group-flush">
                            @forelse($whatsappLogs as $log)
                                <li class="list-group-item p-3 border-bottom">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge {{ $log->status == 'success' ? 'bg-success' : 'bg-danger' }}">
                                            {{ strtoupper($log->status) }}
                                        </span>
                                        <small class="text-muted"><i class="far fa-clock me-1"></i>{{ $log->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="fw-bold small mb-1 text-dark"><i class="fas fa-phone-alt me-1 text-muted"></i> {{ $log->target }}</div>
                                    <div class="small text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $log->message }}</div>
                                    @if($log->status == 'failed')
                                        <div class="small text-danger mt-1 fst-italic">{{ $log->response }}</div>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item text-center p-5 text-muted">
                                    <i class="fas fa-comment-slash fa-3x mb-3 opacity-25"></i>
                                    <p>Belum ada riwayat pesan WhatsApp.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Actions Footer -->
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
            <div class="card-body p-4 bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-end align-items-center gap-3">
                    <button type="button" onclick="syncAndTest()" class="btn btn-light-success px-4 py-2 rounded-pill fw-bold">
                        <i class="fas fa-paper-plane me-2"></i> Test Koneksi WA
                    </button>
                    <button type="button" onclick="syncAndSubmit()" class="btn btn-primary px-5 py-2 rounded-pill fw-bold shadow-primary">
                        <i class="fas fa-save me-2"></i> Simpan Konfigurasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for saving -->
<form id="saveForm" action="{{ route('settings.whatsapp.update') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="wa_vendor" id="hidden_wa_vendor">
    <input type="hidden" name="wa_notify_number" id="hidden_wa_notify_number">
    <input type="hidden" name="wa_token" id="hidden_wa_token">
    <input type="hidden" name="wa_delay" id="hidden_wa_delay">
    <input type="hidden" name="wa_send_pdf" id="hidden_wa_send_pdf">
    <input type="hidden" name="telegram_bot_token" id="hidden_telegram_bot_token">
    <input type="hidden" name="telegram_chat_id" id="hidden_telegram_chat_id">
    <input type="hidden" name="telegram_maintenance_token" id="hidden_telegram_maintenance_token">
    <input type="hidden" name="telegram_maintenance_chat_id" id="hidden_telegram_maintenance_chat_id">
    <input type="hidden" name="telegram_vendor_token" id="hidden_telegram_vendor_token">
    <input type="hidden" name="telegram_vendor_chat_id" id="hidden_telegram_vendor_chat_id">
    <input type="hidden" name="telegram_backbone_token" id="hidden_telegram_backbone_token">
    <input type="hidden" name="telegram_backbone_chat_id" id="hidden_telegram_backbone_chat_id">
</form>

<!-- Hidden form for testing WA -->
<form id="testForm" action="{{ route('settings.whatsapp.test') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="wa_vendor" id="test_wa_vendor">
    <input type="hidden" name="wa_notify_number" id="test_wa_notify_number">
    <input type="hidden" name="wa_token" id="test_wa_token">
</form>
@endsection

@section('scripts')
<script>
    function toggleTokenVisibility(btn) {
        const input = btn.parentElement.querySelector('input');
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash text-muted';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye text-muted';
        }
    }

    function syncAndSubmit() {
        document.getElementById('hidden_wa_vendor').value = document.querySelector('select[name="wa_vendor"]').value;
        document.getElementById('hidden_wa_notify_number').value = document.querySelector('input[name="wa_notify_number"]').value;
        document.getElementById('hidden_wa_token').value = document.querySelector('input[name="wa_token"]').value;
        document.getElementById('hidden_wa_delay').value = document.querySelector('input[name="wa_delay"]').value;
        document.getElementById('hidden_wa_send_pdf').value = document.getElementById('wa_send_pdf').checked ? '1' : '0';
        document.getElementById('hidden_telegram_bot_token').value = document.querySelector('input[name="telegram_bot_token"]').value;
        document.getElementById('hidden_telegram_chat_id').value = document.querySelector('input[name="telegram_chat_id"]').value;
        document.getElementById('hidden_telegram_maintenance_token').value = document.querySelector('input[name="telegram_maintenance_token"]').value;
        document.getElementById('hidden_telegram_maintenance_chat_id').value = document.querySelector('input[name="telegram_maintenance_chat_id"]').value;
        document.getElementById('hidden_telegram_vendor_token').value = document.querySelector('input[name="telegram_vendor_token"]').value;
        document.getElementById('hidden_telegram_vendor_chat_id').value = document.querySelector('input[name="telegram_vendor_chat_id"]').value;
        document.getElementById('hidden_telegram_backbone_token').value = document.querySelector('input[name="telegram_backbone_token"]').value;
        document.getElementById('hidden_telegram_backbone_chat_id').value = document.querySelector('input[name="telegram_backbone_chat_id"]').value;
        
        Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });
        document.getElementById('saveForm').submit();
    }

    function syncAndTest() {
        document.getElementById('test_wa_vendor').value = document.querySelector('select[name="wa_vendor"]').value;
        document.getElementById('test_wa_notify_number').value = document.querySelector('input[name="wa_notify_number"]').value;
        document.getElementById('test_wa_token').value = document.querySelector('input[name="wa_token"]').value;
        
        Swal.fire({ title: 'Mengetes...', text: 'Mengirim pesan uji coba', allowOutsideClick: false, didOpen: () => { Swal.showLoading() } });
        document.getElementById('testForm').submit();
    }
</script>
@endsection

@section('styles')
<style>
    .backdrop-blur { backdrop-filter: blur(10px); }
    .x-small { font-size: 0.65rem; letter-spacing: 0.05rem; }
    .bg-success-light { background-color: rgba(40, 167, 69, 0.1); }
    .bg-primary-light { background-color: rgba(67, 97, 238, 0.1); }
    .bg-info-light { background-color: rgba(23, 162, 184, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    
    .icon-box {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .modern-input-group {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.2s ease;
    }
    
    .modern-input-group:focus-within {
        border-color: #4361ee;
        box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
        background: #fff;
    }

    .modern-input-group .input-group-text {
        background: transparent;
        border: none;
        color: #adb5bd;
        padding-left: 1rem;
    }

    .modern-input-group .form-control {
        background: transparent;
        border: none;
        padding: 0.6rem 1rem;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .modern-input-group .form-control:focus {
        box-shadow: none;
    }

    .modern-select {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 12px;
        padding: 0.6rem 1rem;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .feature-toggle {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .feature-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }

    .accordion-custom .accordion-button {
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .accordion-custom .accordion-button:not(.collapsed) {
        background: #fff;
        color: inherit;
        box-shadow: none;
    }

    .btn-light-success {
        background: #e7f5ed;
        color: #28a745;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-light-success:hover {
        background: #d4edda;
        color: #1e7e34;
    }

    .shadow-primary {
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3) !important;
    }

    .alert-soft-success {
        background-color: #e7f5ed;
        color: #1e7e34;
    }

    .pulse-container {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #28a745;
        border-radius: 50%;
        position: relative;
    }

    .pulse-dot::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: inherit;
        border-radius: inherit;
        animation: pulse-ring 1.5s cubic-bezier(0.24, 0, 0.38, 1) infinite;
    }

    @keyframes pulse-ring {
        0% { transform: scale(0.33); opacity: 1; }
        80%, 100% { transform: scale(3); opacity: 0; }
    }

    body { background-color: #f4f7fe; }

    /* 3D Flip Card Styles */
    .flip-card-container {
        perspective: 1000px;
        height: 100%;
        min-height: 550px;
    }
    .flip-card-inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1);
        transform-style: preserve-3d;
    }
    .flip-card-inner.flipped {
        transform: rotateY(180deg);
    }
    .flip-card-front, .flip-card-back {
        position: absolute;
        width: 100%;
        height: 100%;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }
    .flip-card-back {
        transform: rotateY(180deg);
    }
</style>
@endsection
