<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Detail Tagihan
        </h2>
    </x-slot>

    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Informasi Tagihan
                </h5>
            </div>

            <div class="card-body">

                <table class="table table-borderless">

                    <tr>
                        <th width="250">ID Pelanggan</th>
                        <td>{{ $tagihan->pelanggan->id_pelanggan }}</td>
                    </tr>

                    <tr>
                        <th>Nama Pelanggan</th>
                        <td>{{ $tagihan->pelanggan->nama_pelanggan }}</td>
                    </tr>

                    <tr>
                        <th>Nomor WhatsApp</th>
                        <td>{{ $tagihan->pelanggan->nomor_whatsapp }}</td>
                    </tr>

                    <tr>
                        <th>Periode</th>
                        <td>{{ $tagihan->periode }}</td>
                    </tr>

                    <tr>
                        <th>Nominal</th>
                        <td>
                            Rp {{ number_format($tagihan->nominal,0,',','.') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Jatuh Tempo</th>
                        <td>
                            {{ $tagihan->jatuh_tempo->format('d F Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>

                            @if($tagihan->status_pembayaran == 'Belum Bayar')

                                <span class="badge bg-warning">
                                    Belum Bayar
                                </span>

                            @else

                                <span class="badge bg-success">
                                    Lunas
                                </span>

                            @endif

                        </td>
                    </tr>

                    <tr>
                        <th>Keterangan</th>
                        <td>
                            {{ $tagihan->keterangan ?? '-' }}
                        </td>
                    </tr>

                </table>

            </div>

            <div class="card-footer d-flex justify-content-between">

                <a href="{{ route('tagihan.index') }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>

                @if($tagihan->status_pembayaran == 'Belum Bayar')

                    <a href="{{ route('tagihan.reminder',$tagihan->id) }}"
                        class="btn btn-success">

                        <i class="bi bi-whatsapp"></i>
                        Kirim Reminder

                    </a>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>