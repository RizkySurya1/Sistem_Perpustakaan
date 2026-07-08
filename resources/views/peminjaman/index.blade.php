@extends('layouts.app')
@section('title', 'Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Data Peminjaman</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('export.peminjaman.excel') }}" class="btn btn-outline-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
        <a href="{{ route('export.peminjaman.pdf') }}" class="btn btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Catat Peminjaman</a>
    </div>
</div>

<div class="card p-3">
    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:320px;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama anggota..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th><th>Anggota</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Jumlah Buku</th><th>Status</th><th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamen as $p)
                <tr>
                    <td>{{ $loop->iteration + ($peminjamen->currentPage()-1)*$peminjamen->perPage() }}</td>
                    <td>{{ $p->anggota->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d-m-Y') }}</td>
                    <td>{{ $p->detail->sum('jumlah') }}</td>
                    <td>
                        @if($p->status == 'dipinjam')
                            <span class="badge text-bg-warning">Dipinjam</span>
                        @elseif($p->status == 'dikembalikan')
                            <span class="badge text-bg-success">Dikembalikan</span>
                        @else
                            <span class="badge text-bg-danger">Terlambat</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('peminjaman.show', $p) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                        <form action="{{ route('peminjaman.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data peminjaman ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Belum ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $peminjamen->links() }}
</div>
@endsection
