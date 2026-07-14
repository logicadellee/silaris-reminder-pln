<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Edit Pelanggan',
            'description' => 'Perbarui data pelanggan yang sudah terdaftar.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Form Edit Pelanggan',
        'description' => 'Ubah data kontak dan status pelanggan sesuai kebutuhan operasi.',
    ])
        @include('pelanggan.partials.form', ['pelanggan' => $pelanggan])
    @endinclude
</x-app-layout>
