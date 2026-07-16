<x-app-layout>

    <x-slot name="header">
        <h2 class="fw-bold mb-0">
            Kirim Reminder WhatsApp
        </h2>
    </x-slot>

    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    Preview Pesan Reminder
                </h5>
            </div>

            <div class="card-body">

                <div class="mb-3">
                    <label class="form-label">Nama Pelanggan</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $tagihan->pelanggan->nama_pelanggan }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor WhatsApp</label>

                    <input
                        type="text"
                        class="form-control"
                        value="{{ $tagihan->pelanggan->nomor_whatsapp }}"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Pesan</label>

                    <textarea
                        class="form-control"
                        rows="12"
                        readonly>{{ $pesan }}</textarea>
                </div>

            </div>

            <div class="card-footer d-flex justify-content-between">

                <a href="{{ route('tagihan.show',$tagihan->id) }}"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>

                <form
                    action="{{ route('tagihan.send',$tagihan->id) }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="bi bi-whatsapp"></i>
                        Kirim WhatsApp

                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>