<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backbone;
use App\Models\User;

class BackboneSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            Backbone::create([
                'lokasi' => 'Jl. Diponegoro No. 1',
                'tiang_odp' => 'ODP-SMG-01',
                'action' => 'Pemasangan Splitter Baru',
                'titik_koordinat' => '-6.987, 110.421',
                'ratio' => '1:8',
                'splitter' => 'PLC 1/8',
                'redaman_input' => '-14.5dBm',
                'redaman_output' => '-17.8dBm',
                'tehnisi_1' => 'Andi',
                'tehnisi_2' => 'Budi',
                'keterangan' => 'Selesai tepat waktu, sinyal stabil.',
                'user_id' => $user->id,
            ]);
        }
    }
}
