@extends('layouts.app')

@section('content')
<h2>Tambah Kandidat</h2>
<form action="{{ route('candidates.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Kandidat</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Visi</label>
        <textarea name="vision" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Misi</label>
        <textarea name="mission" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
