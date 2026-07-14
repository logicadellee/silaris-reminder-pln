@props(['pelanggan' => null])

@php
    $isEdit = $pelanggan instanceof \App\Models\Pelanggan;
@endphp

<form action="{{ $isEdit ? route('pelanggan.update', $pelanggan) : route('pelanggan.store') }}" method="POST" class="row g-3">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="col-md-6">
        <label for="id_pelanggan" class="form-label">ID Pelanggan</label>
        <input type="text" class="form-control @error('id_pelanggan') is-invalid @enderror" id="id_pelanggan" name="id_pelanggan" value="{{ old('id_pelanggan', $pelanggan?->id_pelanggan) }}" required>
        @error('id_pelanggan')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan?->nama_pelanggan) }}" required>
        @error('nama_pelanggan')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nomor_whatsapp" class="form-label">Nomor WhatsApp</label>
        <input type="text" class="form-control @error('nomor_whatsapp') is-invalid @enderror" id="nomor_whatsapp" name="nomor_whatsapp" value="{{ old('nomor_whatsapp', $pelanggan?->nomor_whatsapp) }}" placeholder="0812xxxxxxxx">
        @error('nomor_whatsapp')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="tarif" class="form-label">Tarif</label>
        <input type="text" class="form-control @error('tarif') is-invalid @enderror" id="tarif" name="tarif" value="{{ old('tarif', $pelanggan?->tarif) }}" placeholder="R1/450 VA">
        @error('tarif')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="daya" class="form-label">Daya</label>
        <input type="text" class="form-control @error('daya') is-invalid @enderror" id="daya" name="daya" value="{{ old('daya', $pelanggan?->daya) }}">
        @error('daya')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3">
        <label for="status_pelanggan" class="form-label">Status</label>
        <select class="form-select @error('status_pelanggan') is-invalid @enderror" id="status_pelanggan" name="status_pelanggan">
            <option value="Aktif" {{ old('status_pelanggan', $pelanggan?->status_pelanggan) === 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ old('status_pelanggan', $pelanggan?->status_pelanggan) === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        @error('status_pelanggan')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="peruntukan_listrik" class="form-label">Peruntukan Listrik</label>
        <input type="text" class="form-control @error('peruntukan_listrik') is-invalid @enderror" id="peruntukan_listrik" name="peruntukan_listrik" value="{{ old('peruntukan_listrik', $pelanggan?->peruntukan_listrik) }}">
        @error('peruntukan_listrik')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $pelanggan?->alamat) }}</textarea>
        @error('alamat')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12 d-flex justify-content-end gap-2">
        <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Pelanggan' }}</button>
    </div>
</form>
