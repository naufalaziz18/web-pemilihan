@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Hasil Voting</h2>

    <div class="mb-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
    </div>

    @if(isset($results) && count($results) > 0)
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
                @foreach($results as $index => $result)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->votes_count }}</td>
                        <td>
                            @php
                                $percentage = $totalVotes > 0 ? round(($result->votes_count / $totalVotes) * 100, 2) : 0;
                            @endphp
                            {{ $percentage }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="alert alert-info mt-3">
            Total Suara Masuk: <b>{{ $totalVotes }}</b>
        </div>
    @else
        <div class="alert alert-warning text-center">
            Belum ada data voting yang masuk.
        </div>
    @endif
</div>
@endsection
