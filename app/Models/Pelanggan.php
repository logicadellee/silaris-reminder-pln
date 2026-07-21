<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

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
}