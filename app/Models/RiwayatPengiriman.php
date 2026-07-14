<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPengiriman extends Model
{
    use HasFactory;

    protected $table = 'riwayat_pengirimans';

    protected $fillable = [
        'pelanggan_id',
        'tagihan_id',
        'user_id',
        'template_nama',
        'isi_pesan',
        'status_pengiriman',
        'waktu_kirim',
        'response_code',
        'response_message',
        'keterangan',
    ];

    protected $casts = [
        'waktu_kirim' => 'datetime',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
