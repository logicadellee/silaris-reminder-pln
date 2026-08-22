<x-app-layout>
    <x-slot name="header">
        @include('components.admin.page-header', [
            'title' => 'Profil Pelanggan',
        ])
    </x-slot>

    <x-admin.section-card>

        {{-- Identity Header --}}
        <div class="d-flex align-items-center gap-3 px-3 pt-3 pb-2">
            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold"
                 style="width:56px;height:56px;font-size:1.2rem;">
                {{ strtoupper(substr($pelanggan->nama_pelanggan, 0, 2)) }}
            </div>
            <div>
                <p class="fw-bold mb-0 fs-5">{{ $pelanggan->nama_pelanggan }}</p>
                <small class="text-muted">Pelanggan {{ $pelanggan->peruntukan_listrik ?? '-' }}</small>
            </div>
        </div>

        {{-- Info Grid --}}
        <div class="row g-3 px-3 pb-3 mt-1">
            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">ID Pelanggan</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->id_pelanggan }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Nama Pelanggan</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->nama_pelanggan }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Nomor WhatsApp</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">
                        @if($pelanggan->nomor_whatsapp)
                            {{ $pelanggan->nomor_whatsapp }}
                        @else
                            <span class="badge text-bg-warning">Belum ada</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Golongan Tarif</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->tarif ?? '-' }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Daya</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->daya ? $pelanggan->daya . ' VA' : '-' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Peruntukan Listrik</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->peruntukan_listrik ?? '-' }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100 bg-light">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Nominal Tagihan</small>
                    <p class="fw-bold mb-0 mt-1 fs-6 text-primary">
                        @if($tagihans->isNotEmpty())
                            Rp {{ number_format($tagihans->first()->nominal, 0, ',', '.') }}
                        @else
                            <span class="text-muted small">Belum ada tagihan</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border rounded-3 p-3 h-100">
                    <small class="text-muted text-uppercase fw-semibold" style="font-size:0.7rem;letter-spacing:.05em;">Alamat</small>
                    <p class="fw-bold mb-0 mt-1 fs-6">{{ $pelanggan->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex gap-2 px-3 py-3 border-top bg-light rounded-bottom">
            <a href="{{ route('pelanggan.edit', $pelanggan) }}" class="btn btn-primary btn-sm px-3">
                Edit Data
            </a>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                Kembali
            </a>
        </div>

    </x-admin.section-card>

</x-app-layout>