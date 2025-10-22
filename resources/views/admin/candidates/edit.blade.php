@extends('layouts.app')

@section('content')
<h2>Edit Kandidat</h2>

<form action="{{ route('candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Kandidat</label>
        <input type="text" name="name" class="form-control" value="{{ $candidate->name }}" required>
    </div>

    <div class="mb-3">
        <label>Visi</label>
        <textarea name="vision" class="form-control" required>{{ $candidate->vision }}</textarea>
    </div>

    <div class="mb-3">
        <label>Misi</label>
        <textarea name="mission" class="form-control" required>{{ $candidate->mission }}</textarea>
    </div>

    <div class="mb-3">
        <label>Foto Kandidat</label><br>
        @if($candidate->photo)
            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Foto Kandidat" width="100" height="100"><br><br>
        @endif
        <input type="file" name="photo" class="form-control" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection
