<x-app-layout>

    <div class="container-fluid">

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
"Yth. Bapak/Ibu {$tagihan->pelanggan->nama_pelanggan},

Dengan hormat,

Kami menginformasikan bahwa Anda memiliki tagihan listrik yang perlu segera dibayarkan dengan rincian sebagai berikut:

ID Pelanggan : {$tagihan->pelanggan->id_pelanggan}
Periode Tagihan : {$periode}
Nominal Tagihan : Rp " . number_format($tagihan->nominal, 0, ',', '.') . "
Jatuh Tempo : {$jatuhTempo}

Mohon untuk segera melakukan pembayaran sebelum tanggal jatuh tempo guna menghindari keterlambatan pembayaran serta menjaga kelancaran layanan kelistrikan.

Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.

Hormat kami,

PT PLN (Persero)
ULP Way Halim";

        @endphp


        {{-- =====================================================
             PREVIEW 1 PELANGGAN
        ====================================================== --}}

        <div class="preview-wrapper">

            <div class="card preview-card shadow-sm border-0">


                {{-- HEADER --}}
                <div class="preview-card-header">

                    <h4>
                        <i class="bi bi-whatsapp"></i>
                        Preview Reminder WhatsApp
                    </h4>

                </div>


                {{-- BODY --}}
                <div class="preview-card-body">


                    {{-- DATA PELANGGAN --}}
                    <div class="preview-data-section">

                        <h6>
                            Data Pelanggan
                        </h6>

                        <hr>


                        <table class="preview-data-table">

                            <tr>
                                <th>Nama</th>

                                <td>
                                    {{ $tagihan->pelanggan->nama_pelanggan }}
                                </td>
                            </tr>


                            <tr>
                                <th>ID Pelanggan</th>

                                <td>
                                    {{ $tagihan->pelanggan->id_pelanggan }}
                                </td>
                            </tr>


                            <tr>
                                <th>Nomor WhatsApp</th>

                                <td>
                                    {{ $tagihan->pelanggan->nomor_whatsapp }}
                                </td>
                            </tr>


                            <tr>
                                <th>Periode</th>

                                <td>
                                    {{ $periode }}
                                </td>
                            </tr>


                            <tr>
                                <th>Nominal</th>

                                <td>
                                    Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}
                                </td>
                            </tr>


                            <tr>
                                <th>Jatuh Tempo</th>

                                <td>
                                    {{ $tagihan->jatuh_tempo_display ?? $jatuhTempo }}
                                </td>
                            </tr>

                        </table>

                    </div>


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


                </div>


                {{-- FOOTER --}}
                <div class="preview-card-footer">

                    <a
                        href="{{ route('tagihan.index') }}"
                        class="btn btn-secondary">

                        <i class="bi bi-arrow-left"></i>
                        Kembali

                    </a>


                    <form
                        action="{{ route('tagihan.send', $tagihan->id) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="bi bi-whatsapp"></i>
                            Kirim WhatsApp

                        </button>

                    </form>

                </div>


            </div>

        </div>

    </div>

</x-app-layout>