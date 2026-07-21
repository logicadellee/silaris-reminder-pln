<div class="row">

    <div class="col-md-6 mb-3">
        <label class="form-label">ID Pelanggan</label>
        <input
            type="text"
            name="id_pelanggan"
            class="form-control"
            value="{{ old('id_pelanggan', $pelanggan->id_pelanggan ?? '') }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Pelanggan</label>
        <input
            type="text"
            name="nama_pelanggan"
            class="form-control"
            value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}"
            required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Nomor WhatsApp</label>
        <input
            type="text"
            name="nomor_whatsapp"
            class="form-control"
            value="{{ old('nomor_whatsapp', $pelanggan->nomor_whatsapp ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Tarif</label>
        <input
            type="text"
            name="tarif"
            class="form-control"
            value="{{ old('tarif', $pelanggan->tarif ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Daya</label>
        <input
            type="text"
            name="daya"
            class="form-control"
            value="{{ old('daya', $pelanggan->daya ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Peruntukan</label>
        <input
            type="text"
            name="peruntukan_listrik"
            class="form-control"
            value="{{ old('peruntukan_listrik', $pelanggan->peruntukan_listrik ?? '') }}">
    </div>

    <div class="col-12 mb-3">
        <label class="form-label">Alamat</label>
        <textarea
            name="alamat"
            rows="3"
            class="form-control">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Status</label>

        <select
            name="status_pelanggan"
            class="form-select">

            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>

        </select>
    </div>

</div>