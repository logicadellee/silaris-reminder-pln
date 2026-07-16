<?php

namespace App\Imports;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class TagihanImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip Header
        $rows->shift();

        foreach ($rows as $row) {

            // Lewati jika IDPEL kosong
            if (empty($row[2])) {
                continue;
            }

            // Cari pelanggan berdasarkan IDPEL
            $pelanggan = Pelanggan::where('id_pelanggan', trim($row[2]))->first();

            // Kalau pelanggan belum ada, skip
            if (!$pelanggan) {
                continue;
            }

            // Ambil nominal dari kolom TOTAL
            $nominal = str_replace(',', '', $row[24]);

            Tagihan::updateOrCreate(

                [
                    'pelanggan_id' => $pelanggan->id,
                    'periode' => now()->format('Y-m')
                ],

                [
                    'nominal' => $nominal,
                    'jatuh_tempo' => Carbon::now()->day(20),
                    'status_pembayaran' => 'Belum Bayar',
                    'tanggal_import' => now(),
                    'keterangan' => 'Import Excel PLN'
                ]
            );
        }
    }
}