<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\RiwayatPengiriman;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Tagihan::with('pelanggan');

        // Cari pelanggan
        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('pelanggan', function ($q) use ($search) {

                $q->where('nama_pelanggan', 'like', "%{$search}%")
                ->orWhere('id_pelanggan', 'like', "%{$search}%");

            });
        }

    // Filter status
    if ($request->filled('status')) {

        $query->where('status_pembayaran', $request->status);

    }

    // Filter periode
    if ($request->filled('periode')) {

        $query->where('periode', $request->periode);

    }

        $tagihans = $query
        ->latest()
        ->paginate(30)
        ->withQueryString();

        return view('tagihan.index', compact('tagihans'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('tagihan.create', compact('pelanggans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'periode' => 'required',
            'nominal' => 'required|numeric',
            'jatuh_tempo' => 'required|date',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable',
        ]);

        Tagihan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'periode' => $request->periode,
            'nominal' => $request->nominal,
            'jatuh_tempo' => $request->jatuh_tempo,
            'status_pembayaran' => $request->status_pembayaran,
            'keterangan' => $request->keterangan,
            'tanggal_import' => now(),
        ]);

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Data tagihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan $tagihan)
    {
        $tagihan->load('pelanggan');

        return view('tagihan.show', compact('tagihan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan $tagihan)
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('tagihan.edit', compact('tagihan', 'pelanggans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'periode' => 'required',
            'nominal' => 'required|numeric',
            'jatuh_tempo' => 'required|date',
            'status_pembayaran' => 'required',
            'keterangan' => 'nullable',
        ]);

        $tagihan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'periode' => $request->periode,
            'nominal' => $request->nominal,
            'jatuh_tempo' => $request->jatuh_tempo,
            'status_pembayaran' => $request->status_pembayaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Data tagihan berhasil diperbarui.');
    }

    public function reminder($id)
    {
        $tagihan = \App\Models\Tagihan::with('pelanggan')->findOrFail($id);

        $pesan =
    "Yth. {$tagihan->pelanggan->nama_pelanggan},

    Kami mengingatkan bahwa tagihan listrik Anda dengan rincian berikut:

    ID Pelanggan : {$tagihan->pelanggan->id_pelanggan}
    Periode : {$tagihan->periode}
    Nominal : Rp " . number_format($tagihan->nominal,0,',','.') . "
    Jatuh Tempo : " . $tagihan->jatuh_tempo->format('d-m-Y') . "

    Mohon segera melakukan pembayaran sebelum jatuh tempo.

    Terima kasih.
    PT PLN (Persero) ULP Way Halim";

        return view('tagihan.reminder', compact('tagihan','pesan'));
    }

    public function sendReminder($id)
    {
        $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

        $nomor = $tagihan->pelanggan->nomor_whatsapp;

        // Hilangkan karakter selain angka
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        // Ubah 08xxxx menjadi 628xxxx
        if (substr($nomor, 0, 1) == "0") {
            $nomor = "62" . substr($nomor, 1);
        }

        $pesan = "Yth. {$tagihan->pelanggan->nama_pelanggan},\n\n";
        $pesan .= "Tagihan listrik Anda belum dibayar.\n\n";
        $pesan .= "ID Pelanggan : {$tagihan->pelanggan->id_pelanggan}\n";
        $pesan .= "Periode : {$tagihan->periode}\n";
        $pesan .= "Nominal : Rp " . number_format($tagihan->nominal,0,',','.') . "\n";
        $pesan .= "Jatuh Tempo : " . $tagihan->jatuh_tempo->format('d-m-Y') . "\n\n";
        $pesan .= "Silakan segera melakukan pembayaran.\n";
        $pesan .= "Terima kasih.\n";
        $pesan .= "PT PLN (Persero) ULP Way Halim";


        RiwayatPengiriman::create([

            'pelanggan_id'=>$tagihan->pelanggan_id,

            'tagihan_id'=>$tagihan->id,

            'user_id'=>auth()->id(),

            'template_nama'=>'Reminder Tagihan',

            'isi_pesan'=>$pesan,

            'status_pengiriman'=>'Berhasil',

            'waktu_kirim'=>now(),

            'response_code'=>'200',

            'response_message'=>'Dummy WhatsApp',

            'keterangan'=>'Reminder berhasil dikirim'

        ]);
        
        return redirect(
            "https://wa.me/$nomor?text=" . urlencode($pesan)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan $tagihan)
    {
        $tagihan->delete();

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Data tagihan berhasil dihapus.');
    }
}