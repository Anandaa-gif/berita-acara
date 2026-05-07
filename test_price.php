<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\BeritaAcara;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Mock User
$user = User::first();
Auth::login($user);

$inputPrice = "150.000"; // Simulation of what might come from request if select failed
$cleanBiaya = preg_replace('/[^0-9]/', '', $inputPrice);
$finalBiaya = (int) $cleanBiaya;

echo "Input: $inputPrice\n";
echo "Cleaned: $cleanBiaya\n";
echo "Final: $finalBiaya\n";

$ba = new BeritaAcara();
$ba->nama = "Test";
$ba->no_ktp = "123";
$ba->no_hp = "123";
$ba->alamat = "Test";
$ba->tanggal_registrasi = now();
$ba->paket_berlangganan = "50 Mbps";
$ba->jenis_perangkat = "Test";
$ba->nama_teknisi_1 = "Test";
$ba->biaya_registrasi = $finalBiaya;
$ba->user_id = $user->id;
$ba->save();

echo "Stored Value in DB: " . $ba->biaya_registrasi . "\n";

$regisFee = number_format(round($ba->biaya_registrasi), 0, ',', '.');
echo "Formatted for Message: Rp $regisFee\n";

$ba->delete();
