<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'jenis_kegiatan',
        'lokasi',
        'start_koordinat',
        'end_koordinat',
        'panjang_kabel',
        'banyak_core',
        'jenis_kabel',
        'tehnisi_1',
        'tehnisi_2',
        'tehnisi_3',
        'tehnisi_4',
        'tehnisi_5',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}
