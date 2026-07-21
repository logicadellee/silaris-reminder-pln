<div class="row">

    <div class="col-md-12 mb-3">

        <label class="form-label">
            Pelanggan
        </label>

        <select
            name="pelanggan_id"
            class="form-select"
            required>

            <option value="">-- Pilih Pelanggan --</option>

            @foreach($pelanggans as $pelanggan)

                <option
                    value="{{ $pelanggan->id }}"
                    {{ old('pelanggan_id', $tagihan->pelanggan_id ?? '') == $pelanggan->id ? 'selected' : '' }}>

                    {{ $pelanggan->id_pelanggan }} - {{ $pelanggan->nama_pelanggan }}

                </option>

            @endforeach

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Periode
        </label>

        <input
            type="month"
            name="periode"
            class="form-control"
            value="{{ old('periode', $tagihan->periode ?? '') }}"
            required>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Nominal Tagihan
        </label>

        <input
            type="number"
            name="nominal"
            class="form-control"
            value="{{ old('nominal', $tagihan->nominal ?? '') }}"
            required>

    </div>

</div>

<div class="row">

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Jatuh Tempo
        </label>

        <input
            type="date"
            name="jatuh_tempo"
            class="form-control"
            value="{{ old('jatuh_tempo', isset($tagihan) ? optional($tagihan->jatuh_tempo)->format('Y-m-d') : '') }}"
            required>

    </div>

    <div class="col-md-6 mb-3">

        <label class="form-label">
            Status Pembayaran
        </label>

        <select
            name="status_pembayaran"
            class="form-select">

            <option value="Belum Bayar"
                {{ old('status_pembayaran', $tagihan->status_pembayaran ?? '') == 'Belum Bayar' ? 'selected' : '' }}>
                Belum Bayar
            </option>

            <option value="Lunas"
                {{ old('status_pembayaran', $tagihan->status_pembayaran ?? '') == 'Lunas' ? 'selected' : '' }}>
                Lunas
            </option>

        </select>

    </div>

</div>

<div class="mb-3">

    <label class="form-label">
        Keterangan
    </label>

    <textarea
        name="keterangan"
        rows="3"
        class="form-control">{{ old('keterangan', $tagihan->keterangan ?? '') }}</textarea>

</div>

<div class="text-end">

    <a
        href="{{ route('tagihan.index') }}"
        class="btn btn-secondary">

        Kembali

    </a>

    <button
        type="submit"
        class="btn btn-primary">

        <i class="bi bi-save"></i>

        Simpan

    </button>

</div>