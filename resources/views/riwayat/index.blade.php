<x-app-layout>

<x-slot name="header">

@include('components.admin.page-header',[
'title'=>'Riwayat Pengiriman',
'description'=>'Riwayat reminder WhatsApp kepada pelanggan'
])

</x-slot>

<div class="card shadow-sm border-0">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">
            Riwayat Reminder
        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>No</th>
                        <th>Tanggal</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Template</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($riwayats as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration + ($riwayats->firstItem()-1) }}
                        </td>

                        <td>

                            {{ optional($item->waktu_kirim)->format('d/m/Y H:i') }}

                        </td>

                        <td>

                            {{ $item->pelanggan->id_pelanggan }}

                        </td>

                        <td>

                            {{ $item->pelanggan->nama_pelanggan }}

                        </td>

                        <td>

                            {{ optional($item->tagihan)->periode }}

                        </td>

                        <td>

                            @if($item->status_pengiriman=="Berhasil")

                                <span class="badge bg-success">
                                    Berhasil
                                </span>

                            @elseif($item->status_pengiriman=="Pending")

                                <span class="badge bg-warning">
                                    Pending
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Gagal
                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $item->template_nama }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            Belum ada riwayat pengiriman.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $riwayats->links() }}

        </div>

    </div>

</div>

</x-app-layout>