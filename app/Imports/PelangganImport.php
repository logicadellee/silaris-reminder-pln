<?php

namespace App\Imports;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class PelangganImport implements ToCollection, WithHeadingRow
{
    private $importedCount = 0;
    private $updatedCount = 0;
    private $tagihanCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // 1. Simpan atau update data pelanggan
            $pelanggan = Pelanggan::updateOrCreate(
                ['id_pelanggan' => $row['id_pelanggan']],
                [
                    'nama_pelanggan'      => $row['nama_pelanggan'],
                    'nomor_whatsapp'      => $row['nomor_whatsapp'] ?? null,
                    'tarif'               => $row['tarif'] ?? null,
                    'daya'                => $row['daya'] ?? null,
                    'alamat'              => $row['alamat'] ?? null,
                    'peruntukan_listrik'  => $row['peruntukan_listrik'] ?? null,
                    'status_pelanggan'    => 'Aktif',
                ]
            );

            // Hitung update atau insert baru
            if ($pelanggan->wasRecentlyCreated) {
                $this->importedCount++;
            } else {
                $this->updatedCount++;
            }

            // 2. Simpan data tagihan (kalau ada kolom periode & nominal)
            if (!empty($row['periode']) && !empty($row['nominal'])) {
                Tagihan::updateOrCreate(
                    [
                        'pelanggan_id' => $pelanggan->id,
                        'periode'      => $row['periode'],
                    ],
                    [
                        'nominal'          => $row['nominal'],
                        'jatuh_tempo'      => Carbon::parse($row['jatuh_tempo']),
                        'status_pembayaran' => 'Belum Bayar',
                        'tanggal_import'   => now(),
                        'keterangan'       => $row['keterangan'] ?? null,
                    ]
                );
                $this->tagihanCount++;
            }
        }
    }

    public function getImportedCount() { return $this->importedCount; }
    public function getUpdatedCount()  { return $this->updatedCount; }
    public function getTagihanCount()  { return $this->tagihanCount; }
}