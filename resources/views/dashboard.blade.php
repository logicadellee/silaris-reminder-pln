<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Dashboard SILARIS',
            'description' => 'Ringkasan operasional reminder pembayaran tagihan listrik PLN ULP Way Halim.',
        ])
    </x-slot>

    <div class="row g-4 mb-4">
        @include('components.admin.summary-card', [
            'title' => 'Total Pelanggan',
            'value' => '1.248',
            'icon' => 'people-fill',
            'tone' => 'primary',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Tagihan Belum Dibayar',
            'value' => '184',
            'icon' => 'cash-stack',
            'tone' => 'warning',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Reminder Terkirim',
            'value' => '96',
            'icon' => 'send-fill',
            'tone' => 'success',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Riwayat Konflik',
            'value' => '05',
            'icon' => 'exclamation-triangle-fill',
            'tone' => 'danger',
        ])
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            @include('components.admin.section-card', [
                'title' => 'Antrian Reminder Hari Ini',
                'description' => 'Daftar reminder yang akan dikirim berdasarkan jadwal tagihan.',
            ])
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Nomor Meter</th>
                                <th>Tagihan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Andi Prakoso</td>
                                <td>1234567890</td>
                                <td>Rp 368.000</td>
                                <td><span class="badge text-bg-warning">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td>Rina Lestari</td>
                                <td>2234567891</td>
                                <td>Rp 415.500</td>
                                <td><span class="badge text-bg-success">Terkirim</span></td>
                            </tr>
                            <tr>
                                <td>Hadi Sutrisno</td>
                                <td>3234567892</td>
                                <td>Rp 289.000</td>
                                <td><span class="badge text-bg-primary">Diproses</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endinclude
        </div>

        <div class="col-lg-4">
            @include('components.admin.section-card', [
                'title' => 'Keterangan Operasional',
                'description' => 'Poin penting untuk admin PLN.',
            ])
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0">Pastikan nomor WhatsApp pelanggan valid sebelum reminder dikirim.</li>
                    <li class="list-group-item px-0">Cek status tagihan secara berkala untuk mencegah tunggakan.</li>
                    <li class="list-group-item px-0">Kirim ulang reminder hanya pada pelanggan yang belum membayar.</li>
                </ul>
            @endinclude
        </div>
    </div>
</x-app-layout>
