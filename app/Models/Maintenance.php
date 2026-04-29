<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'nama_pel',
        'alamat_pel',
        'komplain',
        'action',
        'tehnisi_1',
        'tehnisi_2',
        'keterangan',
    ];

    protected $keyType = 'string';
    public $incrementing = false;
}
