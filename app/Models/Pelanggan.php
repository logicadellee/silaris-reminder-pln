<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
        protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'nomor_handphone',
        'tarif',
        'daya',
        'penanggung_jawab',
        'alamat',
        'peruntukan_listrik',
        'koordinat',
        'foto_persil',
        'tanggal_input'
    ];
}
