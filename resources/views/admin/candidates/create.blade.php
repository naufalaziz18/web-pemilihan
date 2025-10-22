@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Kandidat</h2>

    <form action="{{ route('candidates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kandidat</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="vision" class="form-label">Visi</label>
            <textarea name="vision" id="vision" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="mission" class="form-label">Misi</label>
            <textarea name="mission" id="mission" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto Kandidat (Opsional)</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('candidates.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
