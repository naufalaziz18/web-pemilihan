@extends('layouts.app')

@section('content')
<h2>Hasil Voting</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Kandidat</th>
            <th>Jumlah Suara</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $result)
        <tr>
            <td>{{ $result->name }}</td>
            <td>{{ $result->votes_count }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
