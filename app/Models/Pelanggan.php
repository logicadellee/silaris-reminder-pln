<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'nomor_whatsapp',
        'tarif',
        'daya',
        'alamat',
        'peruntukan_listrik',
        'status_pelanggan',
    ];

    public function tagihans(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }

    public function riwayatPengirimans(): HasMany
    {
        return $this->hasMany(RiwayatPengiriman::class);
    }
}