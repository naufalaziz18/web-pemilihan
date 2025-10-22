@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Edit Kandidat</h2>
        <a href="{{ route('candidates.index') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Kandidat</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="vision" class="form-label">Visi</label>
            <textarea name="vision" id="vision" rows="3" class="form-control" required>{{ old('vision', $candidate->vision) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="mission" class="form-label">Misi</label>
            <textarea name="mission" id="mission" rows="3" class="form-control" required>{{ old('mission', $candidate->mission) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </form>
</div>
@endsection
