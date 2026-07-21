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
            value="{{ old('tarif', $pelanggan->tarif ?? '') }}"
            placeholder="Contoh: R1, R2, B1">
        @error('tarif')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Daya</label>
        <input type="text" name="daya" class="form-control @error('daya') is-invalid @enderror"
            value="{{ old('daya', $pelanggan->daya ?? '') }}"
            placeholder="Contoh: 900 VA, 1300 VA">
        @error('daya')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Peruntukan Listrik</label>
        <input type="text" name="peruntukan_listrik" class="form-control @error('peruntukan_listrik') is-invalid @enderror"
            value="{{ old('peruntukan_listrik', $pelanggan->peruntukan_listrik ?? '') }}"
            placeholder="Contoh: Rumah Tangga, Bisnis">
        @error('peruntukan_listrik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label fw-semibold">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror"
            rows="3" placeholder="Alamat lengkap pelanggan">{{ old('alamat', $pelanggan->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Status Pelanggan <span class="text-danger">*</span></label>
        <select name="status_pelanggan" class="form-select @error('status_pelanggan') is-invalid @enderror" required>
            <option value="Aktif" {{ old('status_pelanggan', $pelanggan->status_pelanggan ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ old('status_pelanggan', $pelanggan->status_pelanggan ?? '') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        @error('status_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>