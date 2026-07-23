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

                    $pesan = "Yth. {$tagihan->pelanggan->nama_pelanggan},

Kami mengingatkan bahwa tagihan listrik Anda dengan rincian berikut:

ID Pelanggan : {$tagihan->pelanggan->id_pelanggan}
Periode : {$tagihan->periode}
Nominal : Rp " . number_format($tagihan->nominal,0,',','.') . "
Jatuh Tempo : " . $tagihan->jatuh_tempo->format('d-m-Y') . "

Mohon segera melakukan pembayaran sebelum jatuh tempo.

Terima kasih.

PT PLN (Persero) ULP Way Halim";

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
                                <td>{{ $tagihan->periode }}</td>
                            </tr>

                            <tr>
                                <th>Nominal</th>
                                <td>Rp {{ number_format($tagihan->nominal,0,',','.') }}</td>
                            </tr>

                            <tr>
                                <th>Jatuh Tempo</th>
                                <td>{{ $tagihan->jatuh_tempo->format('d F Y') }}</td>
                            </tr>

                        </table>

                        <hr>

                        <h6 class="fw-bold">

                            Preview Pesan

                        </h6>

                        <div
                            style="
                            background:#e5ddd5;
                            padding:20px;
                            border-radius:15px;">

                            <div
                                style="
                                background:white;
                                padding:18px;
                                border-radius:12px;
                                white-space:pre-line;">

                                {{ $pesan }}

                            </div>

                        </div>

                    </div>

                </div>

                @endforeach

            </div>

            <div class="card-footer d-flex justify-content-between">

                <a
                    href="{{ route('tagihan.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button
                    class="btn btn-success"
                    disabled>

                    <i class="bi bi-whatsapp"></i>

                    Kirim Semua Reminder

                </button>

            </div>

        </div>

    </div>

</x-app-layout>