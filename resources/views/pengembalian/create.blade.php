@extends('layouts.app')
@section('title', 'Catat Pengembalian')

@section('content')
<h4 class="fw-bold mb-3">Catat Pengembalian Buku</h4>
<div class="card p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('pengembalian.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Peminjaman</label>
            <select name="id_pinjam" class="form-select @error('id_pinjam') is-invalid @enderror" required>
                <option value="">-- Pilih Transaksi Peminjaman --</option>
                @foreach($peminjamen as $p)
                    <option value="{{ $p->id_pinjam }}">
                        #{{ $p->id_pinjam }} - {{ $p->anggota->nama }} (jatuh tempo: {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') }})
                    </option>
                @endforeach
            </select>
            @error('id_pinjam')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Dikembalikan</label>
            <input type="date" name="tanggal_dikembalikan" class="form-control @error('tanggal_dikembalikan') is-invalid @enderror" value="{{ old('tanggal_dikembalikan', now()->format('Y-m-d')) }}" required>
            @error('tanggal_dikembalikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <p class="text-muted small">Denda dihitung otomatis Rp 2.000/hari keterlambatan dari tanggal jatuh tempo.</p>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengembalian.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
