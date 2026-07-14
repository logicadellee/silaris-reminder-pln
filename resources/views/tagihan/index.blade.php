<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Data Tagihan',
            'description' => 'Pantau tagihan pelanggan dan status pembayaran listrik.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Daftar Tagihan',
        'description' => 'Menyediakan ringkasan data tagihan untuk reminder.',
    ])
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <th>Periode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Andi Prakoso</td>
                        <td>Juli 2026</td>
                        <td>Rp 368.000</td>
                        <td><span class="badge text-bg-warning">Belum Bayar</span></td>
                    </tr>
                    <tr>
                        <td>Rina Lestari</td>
                        <td>Juli 2026</td>
                        <td>Rp 415.500</td>
                        <td><span class="badge text-bg-success">Lunas</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endinclude
</x-app-layout>
