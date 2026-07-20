<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Imports\PelangganImport;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    /**
     * Menampilkan daftar pelanggan dengan fitur pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pelanggans = Pelanggan::when($search, function ($query) use ($search) {
                $query->where('nama_pelanggan', 'like', '%' . $search . '%')
                      ->orWhere('id_pelanggan', 'like', '%' . $search . '%')
                      ->orWhere('nomor_whatsapp', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('pelanggan.index', compact('pelanggans', 'search'));
    }

    /**
     * Form tambah pelanggan manual.
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
            'id_pelanggan'       => 'required|unique:pelanggans,id_pelanggan',
            'nama_pelanggan'     => 'required',
            'nomor_whatsapp'     => 'nullable',
            'tarif'              => 'nullable',
            'daya'               => 'nullable',
            'alamat'             => 'nullable',
            'peruntukan_listrik' => 'nullable',
            'status_pelanggan'   => 'required',
        ]);

        Pelanggan::create($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Lihat profil detail pelanggan beserta riwayat tagihan.
     */
    public function show(Pelanggan $pelanggan)
    {
        $tagihans = Tagihan::where('pelanggan_id', $pelanggan->id)
            ->orderBy('periode', 'desc')
            ->get();

        return view('pelanggan.show', compact('pelanggan', 'tagihans'));
    }

    /**
     * Form edit pelanggan.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update data pelanggan.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'id_pelanggan'       => 'required|unique:pelanggans,id_pelanggan,' . $pelanggan->id,
            'nama_pelanggan'     => 'required',
            'nomor_whatsapp'     => 'nullable',
            'tarif'              => 'nullable',
            'daya'               => 'nullable',
            'alamat'             => 'nullable',
            'peruntukan_listrik' => 'nullable',
            'status_pelanggan'   => 'required',
        ]);

        $pelanggan->update($request->all());

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
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

    /**
     * Form upload import Excel.
     */
    public function importForm()
    {
        return view('pelanggan.import');
    }

    /**
     * Proses import & sinkronisasi data pelanggan dari Excel.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:51200',
        ]);

        $import = new PelangganImport();
        Excel::import($import, $request->file('file'));

        $msg = "Import berhasil! "
            . "{$import->getImportedCount()} pelanggan baru ditambahkan, "
            . "{$import->getUpdatedCount()} pelanggan diperbarui, "
            . "{$import->getTagihanCount()} tagihan diproses.";

        return redirect()
            ->route('pelanggan.index')
            ->with('success', $msg);
    }
}