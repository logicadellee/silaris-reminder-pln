<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Data Pelanggan',
            'description' => 'Kelola data pelanggan sesuai wilayah ULP Way Halim.',
        ])
    </x-slot>

    <x-admin.section-card title="Daftar Pelanggan" description="Informasi pelanggan yang aktif dan terdaftar dalam sistem.">

        {{-- Alert sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Tombol aksi & search --}}
        <div class="d-flex justify-content-between align-items-center mb-3 gap-2 flex-wrap">
            <form method="GET" action="{{ route('pelanggan.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Cari nama, ID, atau No. WA..." value="{{ $search ?? '' }}">
                <button type="submit" class="btn btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
                @if($search ?? false)
                    <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </form>

            <div class="d-flex gap-2">
                <a href="{{ route('pelanggan.import.form') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel me-1"></i>
                    Import Excel
                </a>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Pelanggan
                </a>
            </div>
        </div>

        {{-- Tabel --}}
        <div class="table-responsive">
            <table class="table align-middle table-hover mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggan</th>
                        <th>Nama</th>
                        <th>No. WhatsApp</th>
                        <th>Tarif</th>
                        <th>Daya</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggans as $index => $pelanggan)
                        <tr>
                            <td>{{ $pelanggans->firstItem() + $index }}</td>
                            <td>{{ $pelanggan->id_pelanggan }}</td>
                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                            <td>
                                @if ($pelanggan->nomor_whatsapp)
                                    {{ $pelanggan->nomor_whatsapp }}
                                @else
                                    <span class="badge text-bg-warning">Belum ada</span>
                                @endif
                            </td>
                            <td>{{ $pelanggan->tarif ?? '-' }}</td>
                            <td>{{ $pelanggan->daya ?? '-' }}</td>
                            <td>
                                <span class="badge {{ $pelanggan->status_pelanggan == 'Aktif' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                    {{ $pelanggan->status_pelanggan }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('pelanggan.show', $pelanggan) }}" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan) }}" method="POST" onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                @if($search ?? false)
                                    Tidak ada pelanggan dengan kata kunci "{{ $search }}"
                                @else
                                    Belum ada data pelanggan. Import Excel untuk memulai.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($pelanggans->hasPages())
            <div class="mt-3">
                {{ $pelanggans->appends(['search' => $search ?? ''])->links() }}
            </div>
        @endif

    </x-admin.section-card>

</x-app-layout>