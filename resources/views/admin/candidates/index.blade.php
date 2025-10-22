@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Daftar Kandidat</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('candidates.create') }}" class="btn btn-primary">+ Tambah Kandidat</a>
    </div>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Foto</th>
                <th style="width: 20%">Nama</th>
                <th style="width: 25%">Visi</th>
                <th style="width: 25%">Misi</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($candidates as $candidate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($candidate->photo)
                            <img src="{{ asset('storage/' . $candidate->photo) }}" alt="Foto Kandidat" width="80" height="80" class="rounded">
                        @else
                            <span class="text-muted">Tidak ada foto</span>
                        @endif
                    </td>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->vision }}</td>
                    <td>{{ $candidate->mission }}</td>
                    <td>
                        <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kandidat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada kandidat yang terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
