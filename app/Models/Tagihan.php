<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'periode',
        'nominal',
        'jatuh_tempo',
        'status_pembayaran',
        'tanggal_bayar',
        'tanggal_import',
        'keterangan',
    ];

    protected $casts = [
        'jatuh_tempo' => 'date',
        'tanggal_bayar' => 'date',
        'tanggal_import' => 'datetime',
        'nominal' => 'decimal:2',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function riwayatPengirimans(): HasMany
    {
        return $this->hasMany(RiwayatPengiriman::class);
    }
}
