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

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('pelanggan', function ($q) use ($search) {

                $q->where('nama_pelanggan', 'like', "%$search%")
                    ->orWhere('id_pelanggan', 'like', "%$search%");
            });
        }

        // Filter Status
        if ($request->filled('status')) {

            $query->where(
                'status_pengiriman',
                $request->status
            );

        }

        $riwayats = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $total = RiwayatPengiriman::count();

        $berhasil = RiwayatPengiriman::where(
            'status_pengiriman',
            'Berhasil'
        )->count();

        $pending = RiwayatPengiriman::where(
            'status_pengiriman',
            'Pending'
        )->count();

        $gagal = RiwayatPengiriman::where(
            'status_pengiriman',
            'Gagal'
        )->count();

        return view(
            'riwayat.index',
            compact(
                'riwayats',
                'total',
                'berhasil',
                'pending',
                'gagal'
            )
        );
    }
}