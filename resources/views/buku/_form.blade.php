<div class="mb-3">
    <label class="form-label">Judul Buku</label>
    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $buku->judul ?? '') }}" required>
    @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Pengarang</label>
    <input type="text" name="pengarang" class="form-control @error('pengarang') is-invalid @enderror" value="{{ old('pengarang', $buku->pengarang ?? '') }}" required>
    @error('pengarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Penerbit</label>
        <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $buku->penerbit ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Tahun Terbit</label>
        <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}">
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Kategori</label>
        <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategoris as $k)
                <option value="{{ $k->id_kategori }}" @selected(old('id_kategori', $buku->id_kategori ?? '') == $k->id_kategori)>{{ $k->nama_kategori }}</option>
            @endforeach
        </select>
        @error('id_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stok" class="form-control" value="{{ old('stok', $buku->stok ?? 0) }}" required min="0">
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Cover Buku (opsional)</label>
    <input type="file" name="cover" class="form-control" accept="image/*">
</div>
