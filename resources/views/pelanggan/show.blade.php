<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Profil Pelanggan',
            'description' => 'Detail informasi pelanggan dan riwayat tagihan.',
        ])
    </x-slot>

    <x-admin.section-card title="Informasi Pelanggan" description="Data lengkap pelanggan terdaftar dalam sistem SILARIS.">

        {{-- Info Grid --}}
        <div class="row g-0">
            <div class="col-md-6 border-end">
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">ID Pelanggan</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->id_pelanggan }}</p>
                </div>
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Nomor WhatsApp</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">
                        @if($pelanggan->nomor_whatsapp)
                            <i class="bi bi-whatsapp text-success me-1"></i>{{ $pelanggan->nomor_whatsapp }}
                        @else
                            <span class="badge text-bg-warning">Belum ada</span>
                        @endif
                    </p>
                </div>
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Daya</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->daya ? $pelanggan->daya . ' VA' : '-' }}</p>
                </div>
                <div class="p-3">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Status</small>
                    <p class="mb-0 mt-1">
                        <span class="badge rounded-pill px-3 py-2 {{ $pelanggan->status_pelanggan == 'Aktif' ? 'text-bg-success' : 'text-bg-secondary' }}">
                            {{ $pelanggan->status_pelanggan }}
                        </span>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Nama Pelanggan</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->nama_pelanggan }}</p>
                </div>
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Golongan Tarif</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->tarif ?? '-' }}</p>
                </div>
                <div class="p-3 border-bottom">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Peruntukan Listrik</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->peruntukan_listrik ?? '-' }}</p>
                </div>
                <div class="p-3">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Alamat</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex gap-2 px-3 py-3 border-top bg-light rounded-bottom">
            <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-primary btn-sm px-3">
                <i class="bi bi-pencil-square me-1"></i> Edit Data
            </a>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </x-admin.section-card>

    {{-- Riwayat Tagihan --}}
    <x-admin.section-card title="Riwayat Tagihan" description="Daftar tagihan listrik pelanggan ini.">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-uppercase small fw-semibold text-muted">Periode</th>
                        <th class="text-uppercase small fw-semibold text-muted">Nominal</th>
                        <th class="text-uppercase small fw-semibold text-muted">Jatuh Tempo</th>
                        <th class="text-uppercase small fw-semibold text-muted">Status</th>
                        <th class="text-uppercase small fw-semibold text-muted">Tanggal Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tagihans as $tagihan)
                        <tr>
                            <td class="fw-semibold">{{ $tagihan->periode }}</td>
                            <td>Rp {{ number_format($tagihan->nominal, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($tagihan->jatuh_tempo)->format('d M Y') }}</td>
                            <td>
                                <span class="badge rounded-pill px-3 {{ $tagihan->status_pembayaran == 'Lunas' ? 'text-bg-success' : 'text-bg-danger' }}">
                                    {{ $tagihan->status_pembayaran }}
                                </span>
                            </td>
                            <td class="text-muted">
                                {{ $tagihan->tanggal_bayar ? \Carbon\Carbon::parse($tagihan->tanggal_bayar)->format('d M Y') : '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                                Belum ada riwayat tagihan untuk pelanggan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin.section-card>

</x-app-layout>