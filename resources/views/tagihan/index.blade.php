<x-app-layout>

    <x-slot name="header">

        <h3 class="fw-bold mb-0">

            Data Tagihan

        </h3>

    </x-slot>

    <div class="container-fluid px-0">

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

        {{-- Filter --}}

        <div class="card shadow-sm border-0 rounded-3 mb-3">

    <!-- <div class="card-body"> -->
        <div class="content-wrapper tagihan-page">
        <h6 class="fw-bold text-primary mb-4">
            <i class="bi bi-funnel-fill"></i>
            Filter Data
        </h6>

        <form action="{{ route('tagihan.index') }}" method="GET">

            <div class="row align-items-end g-3">

                <div class="col-lg-4 col-md-6">

                    <label>Cari Pelanggan</label>

                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        placeholder="ID Pelanggan / Nama Pelanggan">

                </div>

                <div class="col-lg-4 col-md-6">

                    <label>Status</label>

                    <select class="form-select" name="status_reminder">

                        <option value="">Semua Reminder</option>

                        <option value="Belum">
                            Belum Pernah Dikirim
                        </option>

                        <option value="Berhasil">
                            Berhasil
                        </option>

                        <option value="Gagal">
                            Gagal
                        </option>

                    </select>

                </div>

                <div class="col-lg-4 col-md-6">

                    <label>Periode</label>

                    <input
                        type="month"
                        class="form-control"
                        name="periode">

                </div>

                <div class="col-12 mt-4">

                    <div class="filter-action">

                        <button type="submit"
                            class="btn btn-primary px-4">
                            <i class="bi bi-search"></i>
                            Cari
                        </button>

                        <a href="{{ route('tagihan.index') }}"
                            class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-clockwise"></i>
                            Reset
                        </a>

                        <button
                            type="button"
                            id="btnBulkReminder"
                            class="btn btn-success px-4">
                            <i class="bi bi-whatsapp"></i>
                            Kirim Reminder
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

        {{-- Tabel --}}

        <form
        action="{{ route('tagihan.send.bulk') }}"
        method="POST">

        @csrf

        <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

        <h5 class="mb-0 fw-semibold">

            Daftar Tagihan Pelanggan

        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle text-nowrap mb-0">

            <thead>

                <tr>

                    <th width="40">
                    <input
                        type="checkbox"
                        id="checkAll"
                        class="form-check-input">
                    </th>
                    <th>No</th>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>Periode</th>
                    <th>Nominal</th>
                    <th>Jatuh Tempo</th>
                    <th>Status Reminder</th>
                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($tagihans as $tagihan)

                <tr>

                    <td class="text-center">
                        <input
                            type="checkbox"
                            class="form-check-input check-item"
                            name="tagihan[]"
                            value="{{ $tagihan->id }}">
                    </td>

                    <td class="text-center">
                        {{ $loop->iteration }}
                    </td>

                    <td>

                        {{ $tagihan->pelanggan->id_pelanggan }}

                    </td>

                    <td class="text-start fw-medium">

                        {{ $tagihan->pelanggan->nama_pelanggan }}

                    </td>

                    <td>

                        {{ $tagihan->periode }}

                    </td>

                    <td>

                        Rp {{ number_format($tagihan->nominal,0,',','.') }}

                    </td>

                    <td>

                        {{ $tagihan->jatuh_tempo_display }}

                    </td>

                    <td>

                    @if($tagihan->reminder_berhasil)

                    <span class="badge bg-success">

                    Sudah Dikirim

                    </span>

                    @else

                    <span class="badge bg-secondary">

                    Belum Dikirim

                    </span>

                    @endif

                    </td>

                    <td>

                        <div class="d-flex gap-2 justify-content-center">

                            <button
                                type="button"
                                class="btn btn-primary btn-sm btn-detail"
                                data-id="{{ $tagihan->id }}">
                                <i class="bi bi-eye"></i>
                                Detail
                            </button>

                            @if($tagihan->status_pembayaran == 'Belum Bayar')

                            @if($tagihan->reminder_berhasil > 0)

                                <a href="{{ route('tagihan.reminder',$tagihan->id) }}"
                                class="btn btn-warning btn-sm rounded-pill px-3">

                                    <i class="bi bi-arrow-repeat"></i>

                                    Kirim Ulang

                                </a>

                            @else

                                <a href="{{ route('tagihan.reminder',$tagihan->id) }}"
                                class="btn btn-success btn-sm rounded-pill px-3">

                                    <i class="bi bi-whatsapp"></i>

                                    Kirim

                                </a>

                            @endif

                        @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="9" class="text-center py-5">

                        <i class="bi bi-inbox display-3 text-primary"></i>

                        <h5 class="mt-3">

                            Belum ada data tagihan

                        </h5>

                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

            <div class="card-footer bg-white">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <small class="text-muted">

                        Menampilkan
                        {{ $tagihans->firstItem() }}
                        -
                        {{ $tagihans->lastItem() }}
                        dari
                        {{ $tagihans->total() }}
                        data

                    </small>

                    {{ $tagihans->links() }}

                </div>

            </div>

        </form>

    </div>

</div>

<script>

document.getElementById('btnBulkReminder').addEventListener('click', function () {

    let checked = document.querySelectorAll('.check-item:checked');

    if (checked.length === 0) {

        alert('Pilih minimal satu tagihan.');

        return;
    }

    let form = document.createElement('form');

    form.method = 'POST';

    form.action = "{{ route('tagihan.send.bulk') }}";

    // CSRF
    let token = document.createElement('input');

    token.type = 'hidden';

    token.name = '_token';

    token.value = "{{ csrf_token() }}";

    form.appendChild(token);

    checked.forEach(function(item){

        let input = document.createElement('input');

        input.type = 'hidden';

        input.name = 'tagihan[]';

        input.value = item.value;

        form.appendChild(input);

    });

    document.body.appendChild(form);

    form.submit();

});

</script>

<script>
document.querySelectorAll('.btn-detail').forEach(function(btn){

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        fetch('/tagihan/' + id)
        .then(response => response.json())
        .then(data => {

            document.getElementById('d_idpel').textContent =
                data.pelanggan.id_pelanggan;

            document.getElementById('d_nama').textContent =
                data.pelanggan.nama_pelanggan;

            document.getElementById('d_wa').textContent =
                data.pelanggan.nomor_whatsapp ?? '-';

            document.getElementById('d_alamat').textContent =
                data.pelanggan.alamat ?? '-';

            document.getElementById('d_periode').textContent =
                data.periode;

            document.getElementById('d_nominal').textContent =
                "Rp " + Number(data.nominal).toLocaleString('id-ID');

            let tanggal = new Date(data.jatuh_tempo);

            // Paksa tanggal menjadi 20
            tanggal.setDate(20);

            document.getElementById('d_jatuh').textContent =
                tanggal.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

            document.getElementById('d_status').textContent =
                data.status_pembayaran;

            const modalEl = document.getElementById('detailModal');

            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

            modal.show();

        })
        .catch(error => {
            console.error(error);
            alert('Gagal mengambil data.');
        });

    });

});
</script>

<script>

const detailModal = document.getElementById('detailModal');

detailModal.addEventListener('hidden.bs.modal', function () {

    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

    document.body.classList.remove('modal-open');

    document.body.style.removeProperty('padding-right');

});

</script>

<div class="modal fade"
    id="detailModal"
    tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">

                    Detail Tagihan

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <strong>ID Pelanggan</strong>
                        <p id="d_idpel"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Nama Pelanggan</strong>
                        <p id="d_nama"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>WhatsApp</strong>
                        <p id="d_wa"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Alamat</strong>
                        <p id="d_alamat"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Periode</strong>
                        <p id="d_periode"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Nominal</strong>
                        <p id="d_nominal"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Jatuh Tempo</strong>
                        <p id="d_jatuh"></p>
                    </div>

                    <div class="col-md-6">
                        <strong>Status</strong>
                        <p id="d_status"></p>
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>

<script>

const checkAll = document.getElementById('checkAll');
const checkItems = document.querySelectorAll('.check-item');

// Klik checkbox header
checkAll.addEventListener('change', function () {

    checkItems.forEach(item => {
        item.checked = this.checked;
    });

});

// Jika salah satu checkbox di-uncheck,
// checkbox header ikut berubah
checkItems.forEach(item => {

    item.addEventListener('change', function () {

        const total = checkItems.length;
        const checked = document.querySelectorAll('.check-item:checked').length;

        checkAll.checked = (total === checked);

    });

});

</script>

</x-app-layout>