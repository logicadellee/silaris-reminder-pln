<?php

namespace App\Imports;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class PelangganImport implements ToCollection, WithHeadingRow
{
    private $importedCount = 0;
    private $updatedCount = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $pelanggan = Pelanggan::updateOrCreate(
                ['id_pelanggan' => $row['idpel']],
                [
                    'nama_pelanggan'     => $row['nama_pelanggan'] ?? null,
                    'nomor_whatsapp'     => $row['no_handphone'] ?? null,
                    'tarif'              => $row['tarif'] ?? null,
                    'daya'               => $row['daya'] ?? null,
                    'alamat'             => $row['alamat_lengkap'] ?? null,
                    'peruntukan_listrik' => $row['peruntukan_listrik'] ?? null,
                    'status_pelanggan'   => 'Aktif',
                ]
            );

            if ($pelanggan->wasRecentlyCreated) {
                $this->importedCount++;
            } else {
                $this->updatedCount++;
            }

            Tagihan::updateOrCreate(
                [
                    'pelanggan_id' => $pelanggan->id,
                    'periode' => now()->format('Y-m'),
                ],
                [
                    'nominal' => 0,
                    'jatuh_tempo' => now()->endOfMonth(),
                    'status_pembayaran' => 'Belum Bayar',
                    'tanggal_import' => now(),
                    'keterangan' => null,
                ]
            );

            Tagihan::firstOrCreate(
                [
                    'pelanggan_id' => $pelanggan->id,
                ],
                [
                    'periode' => now()->format('Y-m'),
                    'nominal' => 0,
                    'jatuh_tempo' => now()->endOfMonth(),
                    'status_pembayaran' => 'Belum Bayar',
                    'tanggal_import' => now(),
                    'keterangan' => null,
                ]
            );
        }
    }

    public function getImportedCount() { return $this->importedCount; }
    public function getUpdatedCount()  { return $this->updatedCount; }
}