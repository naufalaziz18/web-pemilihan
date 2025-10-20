@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Hasil Voting</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Kandidat</th>
                <th>Jumlah Suara</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($candidates as $index => $candidate)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->votes_count }}</td>
                    <td>
                        @if($totalVotes > 0)
                            {{ number_format(($candidate->votes_count / $totalVotes) * 100, 2) }}%
                        @else
                            0%
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
