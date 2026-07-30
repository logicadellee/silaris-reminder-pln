<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\RiwayatPengiriman;
use App\Models\Tagihan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Dashboard
        $totalPelanggan = Pelanggan::count();

        $totalTagihan = Tagihan::count();

        $totalPengiriman = RiwayatPengiriman::count();

        // Persentase Pengiriman
        $persentasePengiriman = $totalTagihan > 0
            ? min(round(($totalPengiriman / $totalTagihan) * 100, 1), 100)
            : 0;

        return view('dashboard.index', compact(
            'totalPelanggan',
            'totalTagihan',
            'totalPengiriman',
            'persentasePengiriman'
        ));
    }
}