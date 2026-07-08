@extends('layouts.app')
@section('title', 'Anggota')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold mb-0">Data Anggota</h4>
    <a href="{{ route('anggota.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Tambah Anggota</a>
</div>

<div class="card p-3">
    <form method="GET" class="mb-3">
        <div class="input-group" style="max-width:320px;">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/no hp..." value="{{ request('search') }}">
            <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th><th>Nama</th><th>No HP</th><th>Tanggal Daftar</th><th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($anggotas as $a)
                <tr>
                    <td>{{ $loop->iteration + ($anggotas->currentPage()-1)*$anggotas->perPage() }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->no_hp }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->tanggal_daftar)->format('d-m-Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('anggota.edit', $a) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('anggota.destroy', $a) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-3">Belum ada data anggota.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
