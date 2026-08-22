<x-app-layout>

    <x-admin.section-card title="Form Data Pelanggan" description="Lengkapi informasi pelanggan agar dapat digunakan untuk reminder tagihan.">

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

        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf

            @include('pelanggan.partials.form')

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i>
                    Simpan
                </button>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </form>

    </x-admin.section-card>

</x-app-layout>