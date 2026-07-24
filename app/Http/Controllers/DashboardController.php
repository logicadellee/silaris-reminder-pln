<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\RiwayatPengiriman;
use App\Models\Tagihan;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik
        $totalPelanggan = Pelanggan::count();

        $totalTagihan = Tagihan::count();

        $totalLunas = Tagihan::where(
            'status_pembayaran',
            'Lunas'
        )->count();

        $totalBelumBayar = Tagihan::where(
            'status_pembayaran',
            'Belum Bayar'
        )->count();

        $persentaseLunas = $totalTagihan > 0
            ? round(($totalLunas / $totalTagihan) * 100, 1)
            : 0;

        $totalPengiriman = RiwayatPengiriman::count();

        // 5 Tagihan Terdekat
        $tagihanTerdekat = Tagihan::with('pelanggan')
            ->where('status_pembayaran', 'Belum Bayar')
            ->orderBy('jatuh_tempo')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalPelanggan',
            'totalTagihan',
            'totalLunas',
            'totalBelumBayar',
            'persentaseLunas',
            'totalPengiriman',
            'tagihanTerdekat'
        ));
    }
}