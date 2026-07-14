<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Tambah Pelanggan',
            'description' => 'Input data pelanggan baru secara manual ke sistem SILARIS.',
        ])
    </x-slot>

    @include('components.admin.section-card', [
        'title' => 'Form Data Pelanggan',
        'description' => 'Lengkapi informasi pelanggan agar dapat digunakan untuk reminder tagihan.',
    ])
        @include('pelanggan.partials.form')
    @endinclude
</x-app-layout>
