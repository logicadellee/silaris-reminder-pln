<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Dashboard',
            'description' => 'Selamat datang di Sistem Reminder Pembayaran Tagihan Listrik (SILARIS)',
        ])
    </x-slot>

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>

    <div class="row g-4 mb-4">
        @include('components.admin.summary-card', [
            'title' => 'Total Pelanggan',
            'value' => '0',
            'icon' => 'people-fill',
            'tone' => 'primary',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Tagihan Aktif',
            'value' => '0',
            'icon' => 'receipt-cutoff',
            'tone' => 'warning',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Reminder Hari Ini',
            'value' => '0',
            'icon' => 'whatsapp',
            'tone' => 'success',
        ])

        @include('components.admin.summary-card', [
            'title' => 'Berhasil Terkirim',
            'value' => '0',
            'icon' => 'check-circle-fill',
            'tone' => 'info',
        ])
    </div>

    <div class="row g-4">
        <div class="col-12 col-xl-8">
            @include('components.admin.section-card', [
                'title' => 'Statistik Reminder Bulanan',
                'description' => 'Ringkasan data dummy pengiriman reminder per bulan.',
            ])
                <div class="dashboard-chart">
                    <canvas id="monthlyReminderChart" aria-label="Statistik Reminder Bulanan"></canvas>
                </div>
            @endinclude
        </div>

        <div class="col-12 col-xl-4">
            @include('components.admin.section-card', [
                'title' => 'Aktivitas Terbaru',
                'description' => 'Catatan aktivitas sistem yang sedang berjalan.',
            ])
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <span class="fw-semibold">Import Data</span>
                            <span class="badge text-bg-secondary">Dummy</span>
                        </div>
                    </div>
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <span class="fw-semibold">Reminder Berhasil</span>
                            <span class="badge text-bg-success">Berhasil</span>
                        </div>
                    </div>
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <span class="fw-semibold">Reminder Gagal</span>
                            <span class="badge text-bg-danger">Gagal</span>
                        </div>
                    </div>
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between align-items-center gap-3">
                            <span class="fw-semibold">Login Admin</span>
                            <span class="badge text-bg-primary">Aktif</span>
                        </div>
                    </div>
                </div>
            @endinclude
        </div>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-12">
            @include('components.admin.section-card', [
                'title' => 'Tagihan Jatuh Tempo Terdekat',
                'description' => 'Daftar data dummy tagihan yang akan jatuh tempo.',
            ])
                <div class="table-responsive">
                    <table class="table align-middle table-hover mb-0">
                        <thead>
                            <tr>
                                <th>IDPEL</th>
                                <th>Nama Pelanggan</th>
                                <th>Nominal</th>
                                <th>Jatuh Tempo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>123456789012</td>
                                <td>Andi Prakoso</td>
                                <td>Rp 368.000</td>
                                <td>2026-07-15</td>
                                <td><span class="badge text-bg-warning">Menunggu</span></td>
                            </tr>
                            <tr>
                                <td>123456789013</td>
                                <td>Rina Lestari</td>
                                <td>Rp 415.500</td>
                                <td>2026-07-18</td>
                                <td><span class="badge text-bg-success">Terkirim</span></td>
                            </tr>
                            <tr>
                                <td>123456789014</td>
                                <td>Hadi Sutrisno</td>
                                <td>Rp 289.000</td>
                                <td>2026-07-20</td>
                                <td><span class="badge text-bg-primary">Diproses</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endinclude
        </div>
    </div>
</x-app-layout>
