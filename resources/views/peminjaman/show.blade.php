@extends('layouts.app')
@section('title', 'Detail Peminjaman')

@section('content')
<h4 class="fw-bold mb-3">Detail Peminjaman #{{ $peminjaman->id_pinjam }}</h4>

<div class="card p-4 mb-3">
    <div class="row">
        <div class="col-md-6">
            <p><strong>Anggota:</strong> {{ $peminjaman->anggota->nama }}</p>
            <p><strong>Dicatat oleh:</strong> {{ $peminjaman->user->nama }}</p>
        </div>
        <div class="col-md-6">
            <p><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}</p>
            <p><strong>Tanggal Kembali (rencana):</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($peminjaman->status) }}</p>
        </div>
    </div>
</div>

<div class="card p-4 mb-3">
    <h6 class="fw-bold mb-3">Buku yang Dipinjam</h6>
    <table class="table">
        <thead><tr><th>Judul</th><th>Jumlah</th></tr></thead>
        <tbody>
            @foreach($peminjaman->detail as $d)
                <tr><td>{{ $d->buku->judul }}</td><td>{{ $d->jumlah }}</td></tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($peminjaman->pengembalian)
<div class="card p-4">
    <h6 class="fw-bold mb-3">Info Pengembalian</h6>
    <p><strong>Tanggal Dikembalikan:</strong> {{ \Carbon\Carbon::parse($peminjaman->pengembalian->tanggal_dikembalikan)->format('d-m-Y') }}</p>
    <p><strong>Denda:</strong> Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}</p>
</div>
@endif

<a href="{{ route('peminjaman.index') }}" class="btn btn-light mt-3">Kembali</a>
@endsection
