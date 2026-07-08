@extends('layouts.app')
@section('title', 'Tambah Buku')

@section('content')
<h4 class="fw-bold mb-3">Tambah Buku</h4>
<div class="card p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
        @csrf
        @include('buku._form')
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('buku.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
