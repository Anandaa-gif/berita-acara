<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Backbone extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
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
        'keterangan',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}
