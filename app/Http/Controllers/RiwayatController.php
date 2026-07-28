<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPengiriman;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $query = RiwayatPengiriman::with([
            'pelanggan',
            'tagihan'
        ]);

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('pelanggan', function ($q) use ($search) {

                $q->where('nama_pelanggan','like',"%{$search}%")
                    ->orWhere('id_pelanggan','like',"%{$search}%");

            });

        }

        if ($request->filled('status')) {

            $query->where(
                'status_pengiriman',
                $request->status
            );

        }

        $statistik = RiwayatPengiriman::selectRaw("
            COUNT(*) as total,
            SUM(status_pengiriman='Berhasil') as berhasil,
            SUM(status_pengiriman='Pending') as pending,
            SUM(status_pengiriman='Gagal') as gagal
        ")->first();

        $riwayats = $query
            ->latest('waktu_kirim')
            ->paginate(20)
            ->withQueryString();

        return view('riwayat.index', [

            'riwayats' => $riwayats,

            'total' => $statistik->total,

            'berhasil' => $statistik->berhasil,

            'pending' => $statistik->pending,

            'gagal' => $statistik->gagal,

        ]);
    }

}