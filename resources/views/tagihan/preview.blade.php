<x-app-layout>

    <x-slot name="header">

        <h2 class="fw-bold mb-0">
            Preview Reminder WhatsApp
        </h2>

    </x-slot>


    <div class="container-fluid">

        <div class="preview-wrapper">

            {{-- CARD UTAMA--}}

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


                        {{-- CARD SETIAP PELANGGAN --}}

                        <div class="preview-customer-card" data-tagihan-id="{{ $tagihan->id }}">


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
                                        <th>Nomor WhatsApp</th>
                                        <td>{{ $tagihan->pelanggan->nomor_whatsapp }}</td>
                                    </tr>

                                    <tr>
                                        <th>Periode</th>
                                        <td>{{ $periode }}</td>
                                    </tr>

                                    <tr>
                                        <th>Nominal</th>
                                        <td>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                                    </tr>

                                    <tr>
                                        <th>Jatuh Tempo</th>
                                        <td>{{ $jatuhTempo }}</td>
                                    </tr>

                                </table>


                                {{-- PREVIEW PESAN --}}

                                <div class="preview-message-section">

                                    <h6>Preview Pesan</h6>

                                    <hr>

                                    <div class="whatsapp-preview">
                                        <div class="whatsapp-message">
                                            {{ $pesan }}
                                        </div>
                                    </div>

                                </div>


                                {{-- STATUS PENGIRIMAN --}}

                                <div class="preview-send-status" id="status-{{ $tagihan->id }}">
                                    <span class="preview-status-badge status-waiting">
                                        <i class="bi bi-clock"></i>
                                        Menunggu Dikirim
                                    </span>
                                </div>


                            </div>

                        </div>


                    @endforeach


                </div>


                {{-- FOOTER --}}

                <div class="preview-card-footer">

                    <a href="{{ route('tagihan.index') }}" class="btn-preview-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <div class="preview-send-controls">

                        <small id="sendProgress" class="preview-progress-text"></small>

                        <button
                            type="button"
                            id="btnSendAll"
                            class="btn-preview-send"
                            data-ids='{{ $tagihans->pluck('id')->toJson() }}'>

                            <i class="bi bi-send-fill"></i>
                            Kirim Semua Pesan
                            <span class="btn-preview-send-count">{{ $tagihans->count() }}</span>

                        </button>

                    </div>

                </div>


            </div>

        </div>

    </div>


    {{-- KIRIM SATU PER SATU --}}

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        const btnSendAll = document.getElementById('btnSendAll');

        if (!btnSendAll) return;

        const ids = JSON.parse(btnSendAll.dataset.ids || '[]');
        const progressText = document.getElementById('sendProgress');
        const csrfToken = "{{ csrf_token() }}";

        function setStatus(id, state, text) {

            const el = document.getElementById('status-' + id);

            if (!el) return;

            let stateClass = 'status-waiting';
            let icon = 'bi-clock';

            if (state === 'sending') {
                stateClass = 'status-sending';
                icon = 'bi-arrow-repeat';
            } else if (state === 'success') {
                stateClass = 'status-success';
                icon = 'bi-check-circle';
            } else if (state === 'failed') {
                stateClass = 'status-failed';
                icon = 'bi-x-circle';
            }

            el.innerHTML =
                '<span class="preview-status-badge ' + stateClass + '"><i class="bi ' + icon + '"></i> ' + text + '</span>';
        }

        function delay(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function randomDelay() {
            return Math.floor(Math.random() * 4000) + 1000;
        }

        async function sendOne(id) {

            setStatus(id, 'sending', 'Mengirim...');

            try {

                const res = await fetch(`/tagihan/${id}/send-ajax`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });

                const data = await res.json();

                if (data.success) {
                    setStatus(id, 'success', 'Terkirim');
                } else {
                    setStatus(id, 'failed', 'Gagal');
                }

            } catch (err) {

                console.error(err);
                setStatus(id, 'failed', 'Gagal');

            }
        }

        btnSendAll.addEventListener('click', async function () {

            if (ids.length === 0) return;

            btnSendAll.disabled = true;
            btnSendAll.innerHTML = '<i class="bi bi-hourglass-split"></i> Mengirim...';

            for (let i = 0; i < ids.length; i++) {

                if (progressText) {
                    progressText.textContent =
                        `Mengirim pesan ${i + 1} dari ${ids.length}...`;
                }

                await sendOne(ids[i]);

                if (i < ids.length - 1) {
                    await delay(randomDelay());
                }
            }

            if (progressText) {
                progressText.textContent = 'Semua pesan selesai diproses.';
            }

            btnSendAll.innerHTML = '<i class="bi bi-check2-all"></i> Selesai Dikirim';

        });

    });
    </script>

</x-app-layout>