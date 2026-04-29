<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        Vendor::create([
            'jenis_kegiatan' => 'UP 1 UDP 1/8',
            'lokasi' => 'Banteng Mati',
            'start_koordinat' => '-7.123, 110.456',
            'end_koordinat' => '-7.124, 110.457',
            'panjang_kabel' => '500m',
            'banyak_core' => '12 Core',
            'jenis_kabel' => 'ADSS 12C',
            'tehnisi_1' => 'Komandan',
            'tehnisi_2' => 'Budi',
            'tehnisi_3' => 'Joko',
            'tehnisi_4' => 'Ani',
            'tehnisi_5' => 'Siti',
        ]);
    }
}
