<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use App\Models\RiwayatPengiriman;
use Illuminate\Support\Facades\Http;

class TagihanController extends Controller
{
    private array $bulan = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];

    private function buildPesanReminder(Tagihan $tagihan): array
    {
        $pecah = explode('-', $tagihan->periode);

        $periode = $this->bulan[$pecah[1]] . ' ' . $pecah[0];

        $jatuhTempo = '20 ' . $this->bulan[$pecah[1]] . ' ' . $pecah[0];

        $pesan =
"*Yth. Bapak/Ibu {$tagihan->pelanggan->nama_pelanggan},*

Dengan hormat,

Kami menginformasikan bahwa Anda memiliki *tagihan listrik yang perlu segera dibayarkan* dengan rincian sebagai berikut:

*ID Pelanggan* : {$tagihan->pelanggan->id_pelanggan}
*Periode Tagihan* : {$periode}
*Nominal Tagihan* : Rp " . number_format($tagihan->nominal, 0, ',', '.') . "
*Jatuh Tempo* : {$jatuhTempo}

Mohon untuk segera melakukan pembayaran sebelum tanggal jatuh tempo guna menghindari keterlambatan pembayaran serta menjaga kelancaran layanan kelistrikan.

Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.

Hormat kami,

*PT PLN (Persero)*
*ULP Way Halim*";

        return [
            'pesan' => $pesan,
            'periode' => $periode,
            'jatuhTempo' => $jatuhTempo,
        ];
    }

    private function kirimReminderWa(Tagihan $tagihan): bool
    {
        $nomor = preg_replace('/[^0-9]/', '', $tagihan->pelanggan->nomor_whatsapp);

        if (substr($nomor, 0, 1) == "0") {
            $nomor = "62" . substr($nomor, 1);
        }

        $data = $this->buildPesanReminder($tagihan);

        $response = Http::withHeaders([
            'Authorization' => env('FONNTE_TOKEN'),
        ])->post('https://api.fonnte.com/send', [
            'target' => $nomor,
            'message' => $data['pesan'],
        ]);

        $hasil = $response->json();

        $berhasil =
            $response->successful() &&
            isset($hasil['status']) &&
            $hasil['status'] == true;

        RiwayatPengiriman::create([
            'pelanggan_id' => $tagihan->pelanggan_id,
            'tagihan_id' => $tagihan->id,
            'user_id' => auth()->id(),
            'template_nama' => 'Reminder PLN',
            'isi_pesan' => $data['pesan'],
            'status_pengiriman' => $berhasil ? 'Berhasil' : 'Gagal',
            'waktu_kirim' => now(),
            'response_code' => $response->status(),
            'response_message' => json_encode($hasil),
            'keterangan' => 'Fonnte',
        ]);

        return $berhasil;
    }

    public function index(Request $request)
    {
        $totalTagihan = Tagihan::count();

        $totalBelumBayar = Tagihan::where(
            'status_pembayaran',
            'Belum Bayar'
        )->count();

        $totalLunas = Tagihan::where(
            'status_pembayaran',
            'Lunas'
        )->count();

        $query = Tagihan::with('pelanggan')
        ->withCount([
            'riwayatPengirimans as reminder_berhasil' => function ($q) {
                $q->where('status_pengiriman', 'Berhasil');
            }
        ]);

        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
        }

        if ($request->filled('status_reminder')) {

            if ($request->status_reminder == 'Belum') {

                $query->whereDoesntHave('riwayatPengirimans');

            } else {

                $query->whereHas('riwayatPengirimans', function ($q) use ($request) {

                    $q->where('status_pengiriman', $request->status_reminder);

                });

            }

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

        ->orderBy('status_pembayaran')

        ->orderBy('reminder_berhasil')

        ->orderBy('jatuh_tempo')

        ->paginate(10)

        ->withQueryString();

        return view(
            'tagihan.index',
            compact(
                'tagihans',
                'totalTagihan',
                'totalBelumBayar',
                'totalLunas'
            )
        );
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('tagihan.create', compact('pelanggans'));
    }

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

    public function show(Tagihan $tagihan)
    {
        return response()->json(
            $tagihan->load('pelanggan')
        );
    }

    public function edit(Tagihan $tagihan)
    {
        $pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();

        return view('tagihan.edit', compact('tagihan', 'pelanggans'));
    }

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
        $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

        $data = $this->buildPesanReminder($tagihan);

        return view(
            'tagihan.reminder',
            [
                'tagihan' => $tagihan,
                'pesan' => $data['pesan'],
                'periode' => $data['periode'],
                'jatuhTempo' => $data['jatuhTempo'],
            ]
        );
    }

    public function sendReminder($id)
    {
        $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

        $berhasil = $this->kirimReminderWa($tagihan);

        if ($berhasil) {
            return redirect()
                ->route('tagihan.index')
                ->with('success', 'Reminder berhasil dikirim.');
        }

        return redirect()
            ->route('tagihan.index')
            ->with('error', 'Reminder gagal dikirim.');
    }

    public function sendReminderAjax($id)
    {
        $tagihan = Tagihan::with('pelanggan')->findOrFail($id);

        $berhasil = $this->kirimReminderWa($tagihan);

        return response()->json([
            'success' => $berhasil,
            'id' => $tagihan->id,
            'nama' => $tagihan->pelanggan->nama_pelanggan,
            'message' => $berhasil
                ? 'Reminder berhasil dikirim.'
                : 'Reminder gagal dikirim.',
        ]);
    }

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
            'tagihan' => 'required|array',
            'tagihan.*' => 'exists:tagihans,id',
        ]);

        $tagihans = Tagihan::with('pelanggan')
            ->whereIn('id', $request->tagihan)
            ->get();

        return view('tagihan.preview', compact('tagihans'));
    }
}