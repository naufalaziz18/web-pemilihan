@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Judul Halaman --}}
    <h2 class="text-center mb-4 fw-bold text-primary">
        🗳️ Pemilihan Ketua OSIS
    </h2>

    {{-- Alert sukses/error --}}
    @if(session('success'))
        <div class="alert alert-success text-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Jika sudah vote --}}
    @if($hasVoted ?? false)
        <div class="alert alert-info text-center fs-5 shadow-sm">
            ✅ Kamu sudah memberikan suara. Terima kasih atas partisipasimu!
        </div>
    @else
        {{-- Daftar Kandidat --}}
        <div class="row justify-content-center">
            @foreach($candidates as $candidate)
                <div class="col-md-5 col-lg-4 mb-4">
                    <div class="card h-100 shadow-lg border-0 rounded-4 hover-shadow text-center">
                        {{-- Foto Kandidat --}}
                        @if($candidate->photo)
                            <img src="{{ asset('storage/fotos/' . $candidate->photo) }}" 
                                 alt="{{ $candidate->name }}" 
                                 class="card-img-top rounded-top-4"
                                 style="height: 250px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded-top-4" 
                                 style="height: 250px;">
                                <span class="text-muted">Tidak ada foto</span>
                            </div>
                        @endif

                        {{-- Isi Card --}}
                        <div class="card-body">
                            <h4 class="card-title fw-bold text-primary">{{ $candidate->name }}</h4>
                            <hr>
                            <p class="card-text text-start"><strong>Visi:</strong><br>{{ Str::limit($candidate->vision, 120) }}</p>
                            <p class="card-text text-start"><strong>Misi:</strong><br>{{ Str::limit($candidate->mission, 120) }}</p>
                        </div>

                        {{-- Tombol Vote --}}
                        <div class="card-footer bg-transparent border-0 pb-4">
                            <form action="{{ route('vote.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill fw-semibold shadow-sm">
                                    💬 Beri Suara
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
