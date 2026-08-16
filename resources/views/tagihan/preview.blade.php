<x-app-layout>

    <x-slot name="header">

        <h2 class="fw-bold mb-0">
            Preview Reminder WhatsApp
        </h2>

    </x-slot>


    <div class="container-fluid">

        <div class="preview-wrapper">

            {{-- =====================================================
                 CARD UTAMA
            ====================================================== --}}

            <div class="card preview-card shadow-sm border-0">


                {{-- HEADER CARD --}}

                <div class="preview-card-header preview-header-success">

                    <h4>

                        <i class="bi bi-whatsapp"></i>

                        Preview Reminder
                        ({{ $tagihans->count() }} Pelanggan)

                    </h4>

                </div>


                {{-- BODY CARD --}}

                <div class="preview-card-body">


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


                        {{-- =====================================================
                             CARD SETIAP PELANGGAN
                        ====================================================== --}}

                        <div class="preview-customer-card">


                            {{-- IDENTITAS PELANGGAN --}}

                            <div class="preview-customer-header">

                                <strong>
                                    {{ $tagihan->pelanggan->nama_pelanggan }}
                                </strong>

                                <span>
                                    ID: {{ $tagihan->pelanggan->id_pelanggan }}
                                </span>

                            </div>


                            {{-- DATA PELANGGAN --}}

                            <div class="preview-customer-body">


                                <table class="preview-data-table">

                                    <tr>

                                        <th>
                                            Nomor WhatsApp
                                        </th>

                                        <td>
                                            {{ $tagihan->pelanggan->nomor_whatsapp }}
                                        </td>

                                    </tr>


                                    <tr>

                                        <th>
                                            Periode
                                        </th>

                                        <td>
                                            {{ $periode }}
                                        </td>

                                    </tr>


                                    <tr>

                                        <th>
                                            Nominal
                                        </th>

                                        <td>
                                            Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                                        </td>

                                    </tr>


                                    <tr>

                                        <th>
                                            Jatuh Tempo
                                        </th>

                                        <td>
                                            {{ $jatuhTempo }}
                                        </td>

                                    </tr>

                                </table>


                                {{-- PREVIEW PESAN --}}

                                <div class="preview-message-section">

                                    <h6>
                                        Preview Pesan
                                    </h6>

                                    <hr>


                                    <div class="whatsapp-preview">

                                        <div class="whatsapp-message">

                                            {{ $pesan }}

                                        </div>

                                    </div>

                                </div>


                                {{-- BUTTON KIRIM --}}

                                <form
                                    action="{{ route('tagihan.send', $tagihan->id) }}"
                                    method="POST"
                                    class="preview-send-form">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-success">

                                        <i class="bi bi-whatsapp"></i>

                                        Kirim WhatsApp ke
                                        {{ $tagihan->pelanggan->nama_pelanggan }}

                                    </button>

                                </form>


                            </div>

                        </div>


                    @endforeach


                </div>


                {{-- FOOTER --}}

                <div class="preview-card-footer">

                    <a
                        href="{{ route('tagihan.index') }}"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>

                        Kembali

                    </a>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>