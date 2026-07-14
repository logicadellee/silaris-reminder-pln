<x-app-layout>

    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold mb-1">
                    Tambah Tagihan
                </h3>
                <p class="text-muted mb-0">
                    Tambahkan data tagihan pelanggan baru.
                </p>
            </div>

            <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    Form Tambah Tagihan
                </h5>
            </div>

            <div class="card-body">

                <form action="{{ route('tagihan.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Pelanggan
                            </label>

                            <select name="pelanggan_id" class="form-select">

                                <option value="">
                                    -- Pilih Pelanggan --
                                </option>

                                <option value="1">
                                    PLN000001 - Andi Prakoso
                                </option>

                                <option value="2">
                                    PLN000002 - Rina Lestari
                                </option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Periode
                            </label>

                            <input
                                type="month"
                                name="periode"
                                class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Nominal Tagihan
                            </label>

                            <input
                                type="number"
                                name="nominal"
                                class="form-control"
                                placeholder="Masukkan nominal">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Jatuh Tempo
                            </label>

                            <input
                                type="date"
                                name="jatuh_tempo"
                                class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Status Pembayaran
                            </label>

                            <select
                                name="status_pembayaran"
                                class="form-select">

                                <option value="Belum Bayar">
                                    Belum Bayar
                                </option>

                                <option value="Lunas">
                                    Lunas
                                </option>

                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Tanggal Bayar
                            </label>

                            <input
                                type="date"
                                name="tanggal_bayar"
                                class="form-control">
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label fw-semibold">
                                Keterangan
                            </label>

                            <textarea
                                name="keterangan"
                                rows="4"
                                class="form-control"
                                placeholder="Masukkan keterangan..."></textarea>
                        </div>

                    </div>

                    <hr>

                    <div class="text-end">

                        <a href="{{ route('tagihan.index') }}"
                            class="btn btn-secondary">

                            Batal

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-save"></i>

                            Simpan Tagihan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>