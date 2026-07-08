@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')
<h4 class="fw-bold mb-3">Edit Anggota</h4>
<div class="card p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('anggota.update', $anggota) }}">
        @csrf @method('PUT')
        @include('anggota._form')
        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
