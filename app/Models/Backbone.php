<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Backbone extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'jenis_kegiatan',
        'lokasi',
        'tiang_odp',
        'action',
        'titik_koordinat',
        'ratio',
        'splitter',
        'redaman_input',
        'redaman_output',
        'tehnisi_1',
        'tehnisi_2',
        'tehnisi_3',
        'tehnisi_4',
        'tehnisi_5',
        'keterangan',
        'user_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
