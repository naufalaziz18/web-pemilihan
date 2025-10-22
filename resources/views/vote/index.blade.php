@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pilih Kandidat Ketua OSIS</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($hasVoted)
        <div class="alert alert-info text-center">
            Kamu sudah memberikan suara. Terima kasih atas partisipasimu!
        </div>
    @else
        <div class="row">
            @foreach($candidates as $candidate)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidate->name }}</h5>
                            <p><strong>Visi:</strong> {{ $candidate->vision }}</p>
                            <p><strong>Misi:</strong> {{ $candidate->mission }}</p>

                            <form action="{{ route('vote.submit', $candidate->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100">Pilih Kandidat Ini</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
