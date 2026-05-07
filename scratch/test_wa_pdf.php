<?php

use App\Models\BeritaAcara;
use App\Models\Setting;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;

// Bootstrap Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "--- MEMULAI PENGETESAN WA PDF ---\n";

$sendPdf = Setting::get('wa_send_pdf', '0');
// Ambil satu data Berita Acara terakhir untuk tes
$beritaAcara = BeritaAcara::latest()->first();

if (!$beritaAcara) {
    echo "ERROR: Tidak ada data Berita Acara untuk dites. Silakan buat satu data dulu di aplikasi.\n";
    exit;
}

$target = Setting::get('wa_notify_number') ?: $beritaAcara->no_hp;

echo "Target Number: " . $target . "\n";

echo "Menggunakan data pelanggan: " . $beritaAcara->nama . "\n";

$whatsappService = new WhatsappService();
$customerMessage = "*TEST NOTIFIKASI MEGADATA*\nIni adalah pesan uji coba sistem.";
$hash = md5($beritaAcara->id . $beritaAcara->created_at);
$downloadUrl = route('berita-acara.public-download-pdf', ['berita_acara' => $beritaAcara->id, 'hash' => $hash]);

if ($sendPdf == '1') {
    echo "Mencoba mengirim dengan PDF (Mode ON)...\n";
    // Buat file dummy PDF untuk tes pengiriman
    $filePath = storage_path('app/test_dummy.pdf');
    file_put_contents($filePath, "Dummy PDF Content for Testing");
    
    echo "Memicu sendFile...\n";
    $success = $whatsappService->sendFile($filePath, $customerMessage, $target);
    
    if (file_exists($filePath)) unlink($filePath);

    if (!$success) {
        echo "Gagal kirim PDF (Wajar jika bukan Ultra). Memicu FALLBACK Link...\n";
        $messageWithLink = $customerMessage . "\n\n📄 *Download PDF:* " . $downloadUrl;
        $res = $whatsappService->sendMessage($messageWithLink, $target);
        echo $res ? "BERHASIL: Link cadangan terkirim.\n" : "GAGAL: Link cadangan pun gagal terkirim.\n";
    } else {
        echo "BERHASIL: PDF terkirim (Berarti paket Anda mendukung file).\n";
    }
} else {
    echo "Mode OFF: Mengirim teks biasa saja...\n";
    $res = $whatsappService->sendMessage($customerMessage, $target);
    echo $res ? "BERHASIL: Pesan teks terkirim.\n" : "GAGAL: Pesan teks gagal terkirim.\n";
}

echo "--- PENGETESAN SELESAI ---\n";
