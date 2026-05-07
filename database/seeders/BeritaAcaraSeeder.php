<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BeritaAcara;
use App\Models\User;

class BeritaAcaraSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user) {
            BeritaAcara::create([
                'nama' => 'Budi Santoso',
                'no_ktp' => '1234567890123456',
                'email' => 'budi@example.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'google_maps_link' => 'https://maps.app.goo.gl/9ZpZpZpZpZpZpZpZp',
                'tanggal_registrasi' => now(),
                'paket_berlangganan' => '50 Mbps',
                'jenis_perangkat' => 'Modem Huawei',
                'mac_address' => 'AA:BB:CC:DD:EE:01',
                'serial_number' => 'SN1234567890',
                'biaya_registrasi' => 150000,
                'nama_teknisi_1' => 'Teknisi A',
                'nama_teknisi_2' => 'Teknisi B',
                'user_id' => $user->id,
            ]);

            BeritaAcara::create([
                'nama' => 'Ani Wijaya',
                'no_ktp' => '6543210987654321',
                'email' => 'ani@example.com',
                'no_hp' => '085678901234',
                'alamat' => 'Komp. Harapan Indah Blok B2, Bekasi',
                'google_maps_link' => 'https://maps.app.goo.gl/yXyXyXyXyXyXyXyX',
                'tanggal_registrasi' => now()->subDays(2),
                'paket_berlangganan' => '100 Mbps',
                'jenis_perangkat' => 'Modem Nokia',
                'mac_address' => 'AA:BB:CC:DD:EE:02',
                'serial_number' => 'SN0987654321',
                'biaya_registrasi' => 250000,
                'nama_teknisi_1' => 'Teknisi C',
                'user_id' => $user->id,
            ]);
        }
    }
}
