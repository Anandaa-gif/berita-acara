<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\User;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            Vendor::create([
                'jenis_kegiatan' => 'Penarikan Kabel',
                'lokasi' => 'Banteng Mati',
                'action' => 'Penarikan Kabel Drop Core',
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
                'user_id' => $user->id,
            ]);
        }
    }
}
