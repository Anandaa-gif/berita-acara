<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintenance;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        Maintenance::create([
            'nama_pel' => 'Budi Santoso',
            'alamat_pel' => 'Jl. Merdeka No. 10, Jakarta',
            'komplain' => 'Internet lambat di sore hari',
            'action' => 'Pembersihan konektor optik dan restart ONT',
            'tehnisi_1' => 'Andi',
            'tehnisi_2' => 'Joko',
            'keterangan' => 'Sinyal kembali normal -18dBm',
        ]);
    }
}
