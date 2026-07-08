@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<h4 class="fw-bold mb-3">Tambah Kategori Buku</h4>
<div class="card p-4" style="max-width:500px;">
    <form method="POST" action="{{ route('kategori.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" required autofocus>
            @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kategori.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
