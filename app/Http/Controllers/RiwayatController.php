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

        $riwayats = $query
            ->latest('waktu_kirim')
            ->paginate(20)
            ->withQueryString();

        return view('riwayat.index',[

            'riwayats'=>$riwayats,

            'total'=>RiwayatPengiriman::count(),

            'berhasil'=>RiwayatPengiriman::where(
                'status_pengiriman',
                'Berhasil'
            )->count(),

            'pending'=>RiwayatPengiriman::where(
                'status_pengiriman',
                'Pending'
            )->count(),

            'gagal'=>RiwayatPengiriman::where(
                'status_pengiriman',
                'Gagal'
            )->count(),

        ]);
    }

}