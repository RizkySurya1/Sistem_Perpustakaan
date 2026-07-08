<div class="mb-3">
    <label class="form-label">Nama Lengkap</label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $anggota->nama ?? '') }}" required>
    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Alamat</label>
    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $anggota->no_hp ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Daftar</label>
        <input type="date" name="tanggal_daftar" class="form-control @error('tanggal_daftar') is-invalid @enderror" value="{{ old('tanggal_daftar', isset($anggota) ? \Carbon\Carbon::parse($anggota->tanggal_daftar)->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
        @error('tanggal_daftar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
