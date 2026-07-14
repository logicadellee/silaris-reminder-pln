<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Data Pelanggan',
            'description' => 'Kelola data pelanggan sesuai wilayah ULP Way Halim.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Daftar Pelanggan',
        'description' => 'Informasi pelanggan yang aktif dan terdaftar dalam sistem.',
    ])
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div></div>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Pelanggan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nomor Meter</th>
                        <th>Tarif</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Andi Prakoso</td>
                        <td>Jl. Soekarno Hatta No. 12</td>
                        <td>1234567890</td>
                        <td>R1/450 VA</td>
                        <td><span class="badge text-bg-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <td>Rina Lestari</td>
                        <td>Jl. Way Halim Baru</td>
                        <td>2234567891</td>
                        <td>R1/900 VA</td>
                        <td><span class="badge text-bg-success">Aktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endinclude
</x-app-layout>
