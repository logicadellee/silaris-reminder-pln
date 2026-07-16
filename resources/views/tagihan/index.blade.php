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


    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>

            <h5 class="mb-1 fw-semibold">
                Data Tagihan PLN
            </h5>

            <small class="text-muted">
                Data tagihan diperoleh melalui proses import file Excel dari PLN.
            </small>

        </div>

    </div>

        {{-- Statistik --}}

        <div class="row g-4 mb-4">

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Total Tagihan

                            </small>

                            <h3 class="fw-bold">

                                {{ $tagihans->count() }}

                            </h3>

                        </div>

                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-receipt fs-2 text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Belum Bayar

                            </small>

                            <h3 class="fw-bold text-warning">

                                {{ $tagihans->where('status_pembayaran','Belum Bayar')->count() }}

                            </h3>

                        </div>

                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-exclamation-circle fs-2 text-warning"></i>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Sudah Lunas

                            </small>

                            <h3 class="fw-bold text-success">

                                {{ $tagihans->where('status_pembayaran','Lunas')->count() }}

                            </h3>

                        </div>

                        <div class="bg-success bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-check-circle fs-2 text-success"></i>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm">

                    <div class="card-body d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Reminder Siap Dikirim

                            </small>

                            <h3 class="fw-bold text-info">

                                {{ $tagihans->where('status_pembayaran','Belum Bayar')->count() }}

                            </h3>

                        </div>

                        <div class="bg-info bg-opacity-10 rounded-circle p-3">

                            <i class="bi bi-whatsapp fs-2 text-info"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Filter --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

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

                                <option value="">

                                    Semua Status

                                </option>

                                <option value="Belum Bayar">

                                    Belum Bayar

                                </option>

                                <option value="Lunas">

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
                                class="form-control">

                        </div>

                        <div class="col-lg-2 d-grid">

                            <label class="form-label text-white">

                                .

                            </label>

                            <button
                                class="btn btn-primary">

                                <i class="bi bi-search"></i>

                                Cari

                            </button>

                        </div>

                    </div>

                </form>

                <hr>

                <div class="d-flex justify-content-between flex-wrap">

                    <div class="d-flex gap-2">

                        <button
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#importModal">

                            <i class="bi bi-file-earmark-excel"></i>

                            Import Excel

                        </button>

                        <!-- <a
                            href="{{ route('tagihan.create') }}"
                            class="btn btn-primary">

                            <i class="bi bi-plus-circle"></i>

                            Tambah Tagihan

                        </a> -->

                    </div>

                </div>

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

            <thead class="table-light">

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
                                class="btn btn-info btn-sm">

                                <i class="bi bi-eye"></i>

                                Detail

                            </a>

                            @if($tagihan->status_pembayaran == 'Belum Bayar')

                                <a
                                    href="{{ route('tagihan.reminder',$tagihan->id) }}"
                                    class="btn btn-success btn-sm">

                                    <i class="bi bi-whatsapp"></i>

                                    Reminder

                                </a>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8" class="text-center py-4">

                        Belum ada data tagihan.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- Modal Import Excel --}}

<div
    class="modal fade"
    id="importModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Import Data Tagihan

                </h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <form
                action="#"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">

                            File Excel

                        </label>

                        <input
                            type="file"
                            name="file"
                            class="form-control"
                            accept=".xlsx,.xls"
                            required>

                    </div>

                    <div class="alert alert-info mb-0">

                        <i class="bi bi-info-circle"></i>

                        Upload file tagihan PLN format
                        <strong>.xlsx</strong>
                        atau
                        <strong>.xls</strong>

                    </div>

                    <div class="alert alert-warning mt-3 mb-0">

                        <i class="bi bi-exclamation-triangle-fill"></i>

                        Data yang diimport akan digunakan sebagai dasar pengiriman reminder pembayaran.
                        Pastikan format file sesuai dengan template PLN.

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="bi bi-upload"></i>

                        Import

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</div>

</x-app-layout>