<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold">Preview Reminder WhatsApp</h2>
    </x-slot>

    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5>{{ $tagihan->pelanggan->nama_pelanggan }}</h5>

                <hr>

                <p><strong>No WA :</strong>
                    {{ $tagihan->pelanggan->nomor_whatsapp }}
                </p>

                <p><strong>Periode :</strong>
                    {{ $tagihan->periode }}
                </p>

                <p><strong>Nominal :</strong>
                    Rp {{ number_format($tagihan->nominal,0,',','.') }}
                </p>

                <p><strong>Jatuh Tempo :</strong>
                    {{ $tagihan->jatuh_tempo->format('d/m/Y') }}
                </p>

                <hr>

                <h6>Preview Pesan</h6>

                <div class="alert alert-success">

Yth. {{ $tagihan->pelanggan->nama_pelanggan }},

Kami mengingatkan bahwa tagihan listrik periode {{ $tagihan->periode }} sebesar Rp {{ number_format($tagihan->nominal,0,',','.') }} belum dibayarkan.

Mohon melakukan pembayaran sebelum tanggal {{ $tagihan->jatuh_tempo->format('d/m/Y') }}.

Terima kasih.

PT PLN (Persero)
ULP Way Halim

                </div>

                <form method="POST"
                        action="{{ route('tagihan.kirim',$tagihan->id) }}">

                    @csrf

                    <button class="btn btn-success">

                        <i class="bi bi-whatsapp"></i>

                        Kirim Reminder

                    </button>

                    <a href="{{ route('tagihan.index') }}"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>