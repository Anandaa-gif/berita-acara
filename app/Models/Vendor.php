<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Vendor extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'jenis_kegiatan',
        'lokasi',
        'action',
        'start_koordinat',
        'end_koordinat',
        'koordinat',
        'panjang_kabel',
        'banyak_core',
        'jenis_kabel',
        'spliter',
        'ratio',
        'redaman_input',
        'redaman_output',
        'keterangan',
        'tehnisi_1',
        'tehnisi_2',
        'tehnisi_3',
        'tehnisi_4',
        'tehnisi_5',
        'user_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
