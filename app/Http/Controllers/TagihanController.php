<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\RiwayatPengiriman;
use Illuminate\Support\Facades\Http;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $periode = now()->format('Y-m');

        $pelanggans = Pelanggan::all();

        foreach ($pelanggans as $pelanggan) {

            Tagihan::firstOrCreate(
                [
                    'pelanggan_id' => $pelanggan->id,
                    'periode' => $periode,
                ],
                [
                    'nominal' => 0,
                    'jatuh_tempo' => now()->endOfMonth(),
                    'status_pembayaran' => 'Belum Bayar',
                    'tanggal_import' => now(),
                ]
            );

        }
        $query = Tagihan::with('pelanggan');

        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('pelanggan', function ($q) use ($search) {

                $q->where('nama_pelanggan', 'like', "%{$search}%")
                ->orWhere('id_pelanggan', 'like', "%{$search}%")
                ->orWhere('nomor_whatsapp', 'like', "%{$search}%");

            });

        }

        $tagihans = $query
            ->latest()
            ->paginate(20)
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
        return response()->json(
            $tagihan->load('pelanggan')
        );
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

    // ubah 08 menjadi 628
    if (substr($nomor, 0, 1) == "0") {
        $nomor = "62" . substr($nomor, 1);
    }

    $pesan = "Yth. {$tagihan->pelanggan->nama_pelanggan}\n\n";
    $pesan .= "Kami mengingatkan bahwa tagihan listrik Anda.\n\n";
    $pesan .= "Periode : {$tagihan->periode}\n";
    $pesan .= "Nominal : Rp " . number_format($tagihan->nominal,0,',','.') . "\n";
    $pesan .= "Jatuh Tempo : ".$tagihan->jatuh_tempo->format('d/m/Y')."\n\n";
    $pesan .= "Mohon segera melakukan pembayaran.\n";
    $pesan .= "Terima kasih.\n";
    $pesan .= "PT PLN (Persero) ULP Way Halim";

    $response = Http::withHeaders([
        'Authorization' => env('FONNTE_TOKEN'),
    ])->post('https://api.fonnte.com/send',[
        'target' => $nomor,
        'message' => $pesan,
    ]);

    if($response->successful()){

        RiwayatPengiriman::create([
            'pelanggan_id'=>$tagihan->pelanggan_id,
            'tagihan_id'=>$tagihan->id,
            'user_id'=>auth()->id(),
            'template_nama'=>'Reminder PLN',
            'isi_pesan'=>$pesan,
            'status_pengiriman'=>'Berhasil',
            'waktu_kirim'=>now(),
            'response_code'=>$response->status(),
            'response_message'=>'Berhasil dikirim',
            'keterangan'=>'Fonnte'
        ]);

        return redirect()
        ->route('tagihan.index')
        ->with('error','Gagal mengirim reminder.');
    }

    RiwayatPengiriman::create([
        'pelanggan_id'=>$tagihan->pelanggan_id,
        'tagihan_id'=>$tagihan->id,
        'user_id'=>auth()->id(),
        'template_nama'=>'Reminder PLN',
        'isi_pesan'=>$pesan,
        'status_pengiriman'=>'Gagal',
        'waktu_kirim'=>now(),
        'response_code'=>$response->status(),
        'response_message'=>$response->body(),
        'keterangan'=>'Fonnte'
    ]);

    return back()->with('error','Gagal mengirim reminder.');
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

        public function sendBulkReminder(Request $request)
        {

        $request->validate([
        'tagihan' => 'required|array'
        ]);

        $tagihans = Tagihan::with('pelanggan')
            ->whereIn('id', $request->tagihan)
            ->get();

        return view('tagihan.preview', compact('tagihans'));
        
        }
}