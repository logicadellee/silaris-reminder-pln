<x-app-layout>

    <x-slot name="header">

        <h2 class="fw-bold mb-0">

            Data Tagihan

        </h2>

    </x-slot>

    <div class="container-fluid">

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="page-title mb-4">
        <p class="text-muted mb-0">
            Menampilkan data tagihan pelanggan yang siap dikirim reminder pembayaran.
        </p>
    </div>

    <div class="row g-4 mb-4">

        {{-- Statistik --}}

        <div class="row g-3 mb-4">

        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card total-card h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small>Total Tagihan</small>

                        <h2>{{ $tagihans->count() }}</h2>

                        <span>Data</span>

                    </div>

                    <i class="bi bi-receipt icon-card"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card warning-card h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small>Belum Bayar</small>

                        <h2>{{ $tagihans->where('status_pembayaran','Belum Bayar')->count() }}</h2>

                        <span>Data</span>

                    </div>

                    <i class="bi bi-exclamation-circle icon-card"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card success-card h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small>Sudah Lunas</small>

                        <h2>{{ $tagihans->where('status_pembayaran','Lunas')->count() }}</h2>

                        <span>Data</span>

                    </div>

                    <i class="bi bi-check-circle icon-card"></i>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6">

            <div class="card dashboard-card info-card h-100">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <div>

                        <small>Reminder Siap Dikirim</small>

                        <h2>{{ $tagihans->where('status_pembayaran','Belum Bayar')->count() }}</h2>

                        <span>Data</span>

                    </div>

                    <i class="bi bi-whatsapp icon-card"></i>

                </div>

            </div>

        </div>

    </div>

        {{-- Filter --}}

        <div class="card border-0 shadow-sm rounded-4 mb-4">

            <div class="card-body">

            <h5 class="fw-bold text-primary mb-4">

            <i class="bi bi-funnel-fill"></i>

            Filter Data

            </h5>

                <form
                    method="GET"
                    action="{{ route('tagihan.index') }}">

                    <div class="row g-3">

                        <div class="col-lg-4">

                            <label class="form-label">

                                Cari Pelanggan

                            </label>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="ID Pelanggan / Nama Pelanggan">

                        </div>

                        <div class="col-lg-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option value="">Semua Status</option>

                                <option value="Belum Bayar"
                                {{ request('status')=='Belum Bayar' ? 'selected' : '' }}>

                                Belum Bayar

                                </option>

                                <option value="Lunas"
                                {{ request('status')=='Lunas' ? 'selected' : '' }}>

                                Lunas

                                </option>

                            </select>

                        </div>

                        <div class="col-lg-3">

                            <label class="form-label">

                                Periode

                            </label>

                            <input
                                type="month"
                                name="periode"
                                value="{{ request('periode') }}"
                                class="form-control">

                        </div>

                        <div class="col-lg-2 d-grid">

                            <label class="form-label text-white">
        .
                            </label>

                            <div class="d-flex gap-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary flex-fill">

                                    <i class="bi bi-search"></i>

                                    Cari

                                </button>

                                <a href="{{ route('tagihan.index') }}"
                                    class="btn btn-outline-secondary">

                                    <i class="bi bi-arrow-clockwise"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </form>

                <hr>

            </div>

        </div>

        {{-- Tabel --}}

        <div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0 fw-semibold">

            Daftar Tagihan Pelanggan

        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-dark">

                <tr>

                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($tagihans as $tagihan)

                <tr>

                    <td>

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $tagihan->pelanggan->id_pelanggan }}

                    </td>

                    <td>

                        {{ $tagihan->pelanggan->nama_pelanggan }}

                    </td>

                    <td>

                        {{ $tagihan->periode }}

                    </td>

                    <td>

                        Rp {{ number_format($tagihan->nominal,0,',','.') }}

                    </td>

                    <td>

                        {{ $tagihan->jatuh_tempo->format('d/m/Y') }}

                    </td>

                    <td>

                        @if($tagihan->status_pembayaran=='Belum Bayar')

                            <span class="badge bg-warning">

                                Belum Bayar

                            </span>

                        @else

                            <span class="badge bg-success">

                                Lunas

                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="d-flex gap-1">

                            <a
                                href="{{ route('tagihan.show',$tagihan->id) }}"
                                class="btn btn-primary btn-sm rounded-pill px-3"

                                <i class="bi bi-eye"></i>

                                Detail

                            </a>

                            @if($tagihan->status_pembayaran == 'Belum Bayar')

                                <a
                                    href="{{ route('tagihan.reminder',$tagihan->id) }}"
                                    class="btn btn-success btn-sm rounded-pill px-3"

                                    <i class="bi bi-whatsapp"></i>

                                    Reminder

                                </a>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center py-5">

                        <i class="bi bi-inbox display-3 text-primary"></i>

                        <h5 class="mt-3">

                            Belum ada data tagihan

                        </h5>

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</x-app-layout>