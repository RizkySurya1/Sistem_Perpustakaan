@extends('layouts.app')
@section('title', 'Tambah Anggota')

@section('content')
<h4 class="fw-bold mb-3">Tambah Anggota</h4>
<div class="card p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('anggota.store') }}">
        @csrf
        @include('anggota._form')
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
