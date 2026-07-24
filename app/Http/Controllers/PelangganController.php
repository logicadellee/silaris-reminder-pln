<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::latest()->paginate(10);

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_pelanggan' => 'required',
        ]);

        $pelanggan = Pelanggan::create($request->all());

        Tagihan::create([
            'pelanggan_id' => $pelanggan->id,
            'periode' => now()->format('Y-m'),
            'nominal' => 0,
            'jatuh_tempo' => now()->endOfMonth(),
            'status_pembayaran' => 'Belum Bayar',
            'tanggal_import' => now(),
        ]);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan,' . $pelanggan->id,
            'nama_pelanggan' => 'required',
        ]);

        $pelanggan->update($request->all());

        Tagihan::where('pelanggan_id', $pelanggan->id)
        ->update([
            'updated_at' => now()
        ]);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        Tagihan::where('pelanggan_id', $pelanggan->id)->delete();

        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus');
    }
}