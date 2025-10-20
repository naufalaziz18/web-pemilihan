@extends('layouts.app')

@section('content')
<h2>Pilih Ketua OSIS</h2>

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if(auth()->user()->has_voted)
    <div class="alert alert-info">Kamu sudah memilih!</div>
@else
<form action="{{ route('vote.store') }}" method="POST">
    @csrf
    <div class="row">
        @foreach($candidates as $candidate)
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h4>{{ $candidate->name }}</h4>
                <p><b>Visi:</b> {{ $candidate->vision }}</p>
                <p><b>Misi:</b> {{ $candidate->mission }}</p>
                <button type="submit" name="candidate_id" value="{{ $candidate->id }}" class="btn btn-success w-100">
                    Pilih
                </button>
            </div>
        </div>
        @endforeach
    </div>
</form>
@endif
@endsection
