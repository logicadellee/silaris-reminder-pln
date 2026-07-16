<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('riwayat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function sendReminder(Tagihan $tagihan)
    {
        $tagihan->load('pelanggan');

        RiwayatPengiriman::create([
            'pelanggan_id' => $tagihan->pelanggan_id,
            'tagihan_id' => $tagihan->id,
            'nomor_whatsapp' => $tagihan->pelanggan->nomor_whatsapp,
            'pesan' => "Reminder pembayaran tagihan listrik.",
            'status' => 'Berhasil',
            'waktu_pengiriman' => now(),
        ]);

        return redirect()
            ->route('tagihan.index')
            ->with('success','Reminder berhasil dikirim (Dummy).');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
