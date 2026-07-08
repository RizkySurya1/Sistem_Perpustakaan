@extends('layouts.app')
@section('title', 'Kategori Buku')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Kategori Buku</h4>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
</div>

<div class="card p-3">
    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:320px;">
            <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Buku</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategoris as $k)
                <tr>
                    <td>{{ $loop->iteration + ($kategoris->currentPage()-1)*$kategoris->perPage() }}</td>
                    <td>{{ $k->nama_kategori }}</td>
                    <td><span class="badge text-bg-secondary">{{ $k->buku_count }}</span></td>
                    <td class="text-end">
                        <a href="{{ route('kategori.edit', $k) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted py-3">Belum ada data kategori.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $kategoris->links() }}
</div>
@endsection
