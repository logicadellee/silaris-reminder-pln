<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\RiwayatPengiriman;
use App\Imports\PelangganImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pelanggans = Pelanggan::when($search, function ($query, $search) {
                $query->where('nama_pelanggan', 'like', "%{$search}%")
                    ->orWhere('id_pelanggan', 'like', "%{$search}%")
                    ->orWhere('nomor_whatsapp', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('pelanggan.index', compact('pelanggans', 'search'));
    }

    public function show(Pelanggan $pelanggan)
    {
        $tagihans = Tagihan::where('pelanggan_id', $pelanggan->id)
            ->latest('periode')
            ->get();

        return view('pelanggan.show', compact('pelanggan', 'tagihans'));
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
            'nominal' => 'nullable|numeric|min:0',
        ]);

        $pelanggan = Pelanggan::create($request->all());

        Tagihan::create([
            'pelanggan_id' => $pelanggan->id,
            'periode' => now()->format('Y-m'),
            'nominal' => $request->input('nominal', 0),
            'jatuh_tempo' => now()->startOfMonth()->addDays(19),
            'tanggal_import' => now(),
        ]);

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    public function edit(Pelanggan $pelanggan)
    {
        $tagihan = Tagihan::where('pelanggan_id', $pelanggan->id)
            ->latest('periode')
            ->first();

        return view('pelanggan.edit', compact('pelanggan', 'tagihan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $request->validate([
            'id_pelanggan' => 'required|unique:pelanggans,id_pelanggan,' . $pelanggan->id,
            'nama_pelanggan' => 'required',
            'nominal' => 'nullable|numeric|min:0',
        ]);

        $pelanggan->update($request->all());

        Tagihan::updateOrCreate(
            [
                'pelanggan_id' => $pelanggan->id,
                'periode' => now()->format('Y-m'),
            ],
            [
                'nominal' => $request->input('nominal', 0),
                'jatuh_tempo' => now()->startOfMonth()->addDays(19),
            ]
        );

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        RiwayatPengiriman::where('pelanggan_id', $pelanggan->id)->delete();
        Tagihan::where('pelanggan_id', $pelanggan->id)->delete();

        $pelanggan->delete();

        return redirect()
            ->route('pelanggan.index')
            ->with('success', 'Data pelanggan berhasil dihapus');
    }

    public function importForm()
    {
        return view('pelanggan.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $import = new PelangganImport;
        Excel::import($import, $request->file('file'));

        return redirect()
            ->route('pelanggan.index')
            ->with('success', "Import selesai: {$import->getImportedCount()} pelanggan baru, {$import->getUpdatedCount()} pelanggan diperbarui.");
    }
}