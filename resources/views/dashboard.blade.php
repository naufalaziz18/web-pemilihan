@extends('layouts.app')

@section('content')
<h2>Dashboard User</h2>
<p>Halo, <b>{{ auth()->user()?->name ?? 'User' }}</b>!</p>

<a href="{{ route('vote.index') }}" class="btn btn-primary">Mulai Voting</a>
<a href="{{ route('vote.result') }}" class="btn btn-success">Lihat Hasil</a>
@endsection
