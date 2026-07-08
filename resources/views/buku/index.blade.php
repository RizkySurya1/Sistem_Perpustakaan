@extends('layouts.app')
@section('title', 'Data Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <h4 class="fw-bold mb-0">Data Buku</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('export.buku.excel') }}" class="btn btn-outline-success"><i class="bi bi-file-earmark-excel"></i> Excel</a>
        <a href="{{ route('export.buku.pdf') }}" class="btn btn-outline-danger"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Buku</a>
    </div>
</div>

<div class="card p-3">
    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:320px;">
            <input type="text" name="search" class="form-control" placeholder="Cari judul/pengarang..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukus as $b)
                <tr>
                    <td>{{ $loop->iteration + ($bukus->currentPage()-1)*$bukus->perPage() }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->pengarang }}</td>
                    <td><span class="badge text-bg-light border">{{ $b->kategori->nama_kategori ?? '-' }}</span></td>
                    <td>{{ $b->tahun_terbit }}</td>
                    <td>
                        @if($b->stok > 0)
                            <span class="badge text-bg-success">{{ $b->stok }}</span>
                        @else
                            <span class="badge text-bg-danger">Habis</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('buku.edit', $b) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('buku.destroy', $b) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-3">Belum ada data buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
