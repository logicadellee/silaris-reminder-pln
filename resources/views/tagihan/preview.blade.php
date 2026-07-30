<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Preview Reminder WhatsApp
        </h2>
    </x-slot>

    <div class="container-fluid">

        <div class="card shadow-sm border-0 rounded-4">

            <div class="card-header bg-success text-white">

                <h4 class="mb-0">
                    <i class="bi bi-whatsapp"></i>
                    Preview Reminder ({{ $tagihans->count() }} Pelanggan)
                </h4>

            </div>

            <div class="card-body">

                @foreach($tagihans as $tagihan)

                    @php

$bulan = [
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
    '12' => 'Desember'
];

$pecah = explode('-', $tagihan->periode);

$periode = $bulan[$pecah[1]] . ' ' . $pecah[0];

$jatuhTempo = '20 ' . $bulan[$pecah[1]] . ' ' . $pecah[0];

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

@endphp

                    <div class="card border mb-4">

                        <div class="card-header bg-light">

                            <strong>
                                {{ $tagihan->pelanggan->nama_pelanggan }}
                            </strong>

                            <span class="text-muted">
                                ({{ $tagihan->pelanggan->id_pelanggan }})
                            </span>

                        </div>

                        <div class="card-body">

                            <table class="table table-borderless">

                                <tr>
                                    <th width="180">Nomor WA</th>
                                    <td>{{ $tagihan->pelanggan->nomor_whatsapp }}</td>
                                </tr>

                                <tr>
                                    <th>Periode</th>
                                    <td>{{ $jatuhTempo }}</td>
                                </tr>

                                <tr>
                                    <th>Nominal</th>
                                    <td>Rp {{ number_format($tagihan->nominal,0,',','.') }}</td>
                                </tr>

                                <tr>
                                    <th>Jatuh Tempo</th>
                                    <td>{{ $jatuhTempo }}</td>
                                </tr>

                            </table>

                            <hr>

                            <h6 class="fw-bold">
                                Preview Pesan
                            </h6>

                            <div style="background:#e5ddd5;padding:20px;border-radius:15px;">

                                <div style="background:white;padding:18px;border-radius:12px;white-space:pre-line;">

                                    {{ $pesan }}

                                </div>

                            </div>

                            <hr>

                            <form action="{{ route('tagihan.send',$tagihan->id) }}"
                                method="POST">

                                @csrf

                                <button type="submit"
                                    class="btn btn-success w-100">

                                    <i class="bi bi-whatsapp"></i>

                                    Kirim WhatsApp ke
                                    {{ $tagihan->pelanggan->nama_pelanggan }}

                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="card-footer">

                <a href="{{ route('tagihan.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</x-app-layout>