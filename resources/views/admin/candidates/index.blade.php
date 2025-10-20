@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Hasil Voting</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 25%">Nama Kandidat</th>
                <th style="width: 20%">Jumlah Suara</th>
                <th style="width: 20%">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($results as $index => $result)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->votes_count }}</td>
                    <td>
                        @php
                            $percentage = $totalVotes > 0 ? round(($result->votes_count / $totalVotes) * 100, 2) : 0;
                        @endphp
                        {{ $percentage }}%
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada hasil voting yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="alert alert-info mt-3">
        Total Suara Masuk: <b>{{ $totalVotes }}</b>
    </div>
</div>
@endsection
