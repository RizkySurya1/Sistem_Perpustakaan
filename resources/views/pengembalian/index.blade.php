@extends('layouts.app')
@section('title', 'Pengembalian & Denda')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Pengembalian &amp; Denda</h4>
    <a href="{{ route('pengembalian.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Catat Pengembalian</a>
</div>

<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr><th>#</th><th>Anggota</th><th>Tanggal Dikembalikan</th><th>Denda</th></tr>
            </thead>
            <tbody>
                @forelse($pengembalians as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->peminjaman->anggota->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_dikembalikan)->format('d-m-Y') }}</td>
                    <td>
                        @if($p->denda > 0)
                            <span class="badge text-bg-danger">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
                        @else
                            <span class="badge text-bg-success">Tidak ada denda</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data pengembalian.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $pengembalians->links() }}
</div>
@endsection
