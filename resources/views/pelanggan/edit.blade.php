<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Edit Pelanggan',
            'description' => 'Perbarui data pelanggan yang terdaftar dalam sistem SILARIS.',
        ])
    </x-slot>

    <x-admin.section-card title="Form Edit Pelanggan" description="Ubah informasi pelanggan sesuai data terbaru.">

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('pelanggan.update', $pelanggan) }}" method="POST">
            @csrf
            @method('PUT')

            @include('pelanggan.partials.form')

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-warning text-white">
                    <i class="bi bi-save me-1"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </form>

    </x-admin.section-card>

</x-app-layout>