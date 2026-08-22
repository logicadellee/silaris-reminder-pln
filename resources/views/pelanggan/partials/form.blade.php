<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">ID Pelanggan <span class="text-danger">*</span></label>
        <input type="text" name="id_pelanggan" class="form-control @error('id_pelanggan') is-invalid @enderror"
            value="{{ old('id_pelanggan', $pelanggan->id_pelanggan ?? '') }}" required>
        @error('id_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nama Pelanggan <span class="text-danger">*</span></label>
        <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror"
            value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan ?? '') }}" required>
        @error('nama_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nomor WhatsApp</label>
        <input type="text" name="nomor_whatsapp" class="form-control @error('nomor_whatsapp') is-invalid @enderror"
            value="{{ old('nomor_whatsapp', $pelanggan->nomor_whatsapp ?? '') }}"
            placeholder="Contoh: 628123456789">
        @error('nomor_whatsapp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Golongan Tarif</label>
        <input type="text" name="tarif" class="form-control @error('tarif') is-invalid @enderror"
            value="{{ old('tarif', $pelanggan->tarif ?? '') }}">
        @error('tarif')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Daya</label>
        <input type="text" name="daya" class="form-control @error('daya') is-invalid @enderror"
            value="{{ old('daya', $pelanggan->daya ?? '') }}">
        @error('daya')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Peruntukan Listrik</label>
        <input type="text" name="peruntukan_listrik" class="form-control @error('peruntukan_listrik') is-invalid @enderror"
            value="{{ old('peruntukan_listrik', $pelanggan->peruntukan_listrik ?? '') }}">
        @error('peruntukan_listrik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Nominal Tagihan</label>
        <div class="input-group">
            <span class="input-group-text">Rp</span>
            <input type="number" name="nominal" class="form-control @error('nominal') is-invalid @enderror"
                value="{{ old('nominal', $tagihan->nominal ?? '') }}" min="0">
        </div>
        @error('nominal')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
            rows="3">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>