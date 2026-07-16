<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        Pelanggan::truncate();

        $data = [

            [
                'id_pelanggan' => 'PLN000001',
                'nama_pelanggan' => 'Andi Saputra',
                'nomor_whatsapp' => '081234567890',
                'tarif' => 'R1',
                'daya' => '1300 VA',
                'alamat' => 'Way Halim',
                'peruntukan_listrik' => 'Rumah Tangga',
                'status_pelanggan' => 'Aktif',
            ],

            [
                'id_pelanggan' => 'PLN000002',
                'nama_pelanggan' => 'Budi Santoso',
                'nomor_whatsapp' => '081234567891',
                'tarif' => 'R1',
                'daya' => '2200 VA',
                'alamat' => 'Sukarame',
                'peruntukan_listrik' => 'Rumah Tangga',
                'status_pelanggan' => 'Aktif',
            ],

            [
                'id_pelanggan' => 'PLN000003',
                'nama_pelanggan' => 'Citra Lestari',
                'nomor_whatsapp' => '081234567892',
                'tarif' => 'B1',
                'daya' => '3500 VA',
                'alamat' => 'Rajabasa',
                'peruntukan_listrik' => 'Bisnis',
                'status_pelanggan' => 'Aktif',
            ],

            [
                'id_pelanggan' => 'PLN000004',
                'nama_pelanggan' => 'Dewi Anggraini',
                'nomor_whatsapp' => '081234567893',
                'tarif' => 'R1',
                'daya' => '1300 VA',
                'alamat' => 'Kedaton',
                'peruntukan_listrik' => 'Rumah Tangga',
                'status_pelanggan' => 'Aktif',
            ],

            [
                'id_pelanggan' => 'PLN000005',
                'nama_pelanggan' => 'Eko Prasetyo',
                'nomor_whatsapp' => '081234567894',
                'tarif' => 'B2',
                'daya' => '5500 VA',
                'alamat' => 'Kemiling',
                'peruntukan_listrik' => 'Bisnis',
                'status_pelanggan' => 'Aktif',
            ],

        ];

        foreach ($data as $item) {
            Pelanggan::create($item);
        }
    }
}