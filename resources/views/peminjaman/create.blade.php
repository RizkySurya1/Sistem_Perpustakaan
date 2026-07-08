@extends('layouts.app')
@section('title', 'Catat Peminjaman')

@section('content')
<h4 class="fw-bold mb-3">Catat Peminjaman Baru</h4>
<div class="card p-4" style="max-width:700px;">
    <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Anggota</label>
            <select name="id_anggota" class="form-select @error('id_anggota') is-invalid @enderror" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach($anggotas as $a)
                    <option value="{{ $a->id_anggota }}" @selected(old('id_anggota') == $a->id_anggota)>{{ $a->nama }}</option>
                @endforeach
            </select>
            @error('id_anggota')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}" required>
                @error('tanggal_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Kembali (rencana)</label>
                <input type="date" name="tanggal_kembali" class="form-control @error('tanggal_kembali') is-invalid @enderror" value="{{ old('tanggal_kembali', now()->addDays(7)->format('Y-m-d')) }}" required>
                @error('tanggal_kembali')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <hr>
        <label class="form-label fw-bold">Daftar Buku Dipinjam</label>
        <div id="bukuWrapper">
            <div class="row buku-row mb-2">
                <div class="col-7">
                    <select name="buku[]" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($bukus as $b)
                            <option value="{{ $b->id_buku }}">{{ $b->judul }} (stok: {{ $b->stok }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" value="1" min="1" required>
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-outline-danger removeRow"><i class="bi bi-x-lg"></i></button>
                </div>
            </div>
        </div>
        <button type="button" id="addRow" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi bi-plus"></i> Tambah Buku</button>
        <br>
        <button class="btn btn-primary">Simpan Peminjaman</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('addRow').addEventListener('click', function () {
        const wrapper = document.getElementById('bukuWrapper');
        const row = wrapper.querySelector('.buku-row').cloneNode(true);
        row.querySelectorAll('select, input').forEach(el => el.value = el.tagName === 'INPUT' ? 1 : '');
        wrapper.appendChild(row);
    });

    document.getElementById('bukuWrapper').addEventListener('click', function (e) {
        if (e.target.closest('.removeRow')) {
            const rows = document.querySelectorAll('.buku-row');
            if (rows.length > 1) e.target.closest('.buku-row').remove();
        }
    });
</script>
@endpush
