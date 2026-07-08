@extends('layouts.app')
@section('title', 'Edit Buku')

@section('content')
<h4 class="fw-bold mb-3">Edit Buku</h4>
<div class="card p-4" style="max-width:600px;">
    <form method="POST" action="{{ route('buku.update', $buku) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('buku._form')
        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('buku.index') }}" class="btn btn-light">Batal</a>
    </form>
</div>
@endsection
