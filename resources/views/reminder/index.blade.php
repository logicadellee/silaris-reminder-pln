<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Reminder Pembayaran',
            'description' => 'Kelola pengiriman reminder pembayaran melalui WhatsApp Gateway.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Jadwal Reminder',
        'description' => 'Pengelompokan reminder berdasarkan status pengiriman.',
    ])
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>Tujuan</th>
                        <th>Waktu</th>
                        <th>Template</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>0812xxxxxx</td>
                        <td>08:00 WIB</td>
                        <td>Tagihan bulan Juli</td>
                        <td><span class="badge text-bg-primary">Terkirim</span></td>
                    </tr>
                    <tr>
                        <td>0813xxxxxx</td>
                        <td>10:30 WIB</td>
                        <td>Pengingat jatuh tempo</td>
                        <td><span class="badge text-bg-warning">Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endinclude
</x-app-layout>
