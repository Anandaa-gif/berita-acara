<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaAcara extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;


    protected $fillable = [
        'nama',
        'no_ktp',
        'email',
        'no_hp',
        'alamat',
        'google_maps_link',
        'tanggal_registrasi',
        'paket_berlangganan',
        'jenis_perangkat',
        'mac_address',
        'serial_number',
        'biaya_registrasi',
        'nama_teknisi_1',
        'nama_teknisi_2',
        'foto_odp',
        'foto_rumah',
        'foto_pelanggan',
        'ttd_pelanggan',
        'ttd_petugas',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
