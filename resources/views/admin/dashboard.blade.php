@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Dashboard Admin</h2>
    <p>Selamat datang, <b>{{ auth()->user()->name ?? 'Admin' }}</b>!</p>

    <div class="d-flex gap-2">
        <a href="{{ route('candidates.index') }}" class="btn btn-primary">Kelola Kandidat</a>
        <a href="{{ route('admin.results') }}" class="btn btn-success">Lihat Hasil Voting</a>
    </div>
</div>
@endsection
