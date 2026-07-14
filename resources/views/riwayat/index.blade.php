<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Riwayat Aktivitas',
            'description' => 'Pantau catatan pengiriman reminder dan status pembayaran pelanggan.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Log Sistem',
        'description' => 'Rangkuman riwayat aktivitas reminder yang telah diproses.',
    ])
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>2026-07-11</td>
                        <td>Reminder WhatsApp</td>
                        <td>Pengiriman unggahan reminder ke pelanggan prioritas</td>
                        <td><span class="badge text-bg-success">Selesai</span></td>
                    </tr>
                    <tr>
                        <td>2026-07-10</td>
                        <td>Tagihan Baru</td>
                        <td>Sinkronisasi tagihan pelanggan dari database</td>
                        <td><span class="badge text-bg-primary">Berhasil</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endinclude
</x-app-layout>
