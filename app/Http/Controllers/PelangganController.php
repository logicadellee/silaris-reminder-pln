<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();

        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Form tambah pelanggan.
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Simpan pelanggan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan',
            'nama_pelanggan' => 'required',
            'nomor_whatsapp' => 'nullable',
            'tarif' => 'nullable',
            'daya' => 'nullable',
            'alamat' => 'nullable',
            'peruntukan_listrik' => 'nullable',
            'status_pelanggan' => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Form edit pelanggan.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update pelanggan.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan,' . $pelanggan->id,
            'nama_pelanggan' => 'required',
            'nomor_whatsapp' => 'nullable',
            'tarif' => 'nullable',
            'daya' => 'nullable',
            'alamat' => 'nullable',
            'peruntukan_listrik' => 'nullable',
            'status_pelanggan' => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diupdate.');
    }

    /**
     * Hapus pelanggan.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}