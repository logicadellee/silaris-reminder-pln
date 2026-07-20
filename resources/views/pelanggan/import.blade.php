<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Import Data Pelanggan',
            'description' => 'Upload file Excel untuk sinkronisasi data pelanggan.',
        ])
    </x-slot>

    <x-admin.section-card title="Upload File Excel" description="Data pelanggan dan tagihan akan otomatis tersinkronisasi.">

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

        <form action="{{ route('pelanggan.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-semibold">File Excel (.xlsx / .xls)</label>
                <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                <div class="form-text">Maksimal ukuran file 10MB.</div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-upload me-1"></i>
                    Import Sekarang
                </button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </form>

    </x-admin.section-card>

</x-app-layout>