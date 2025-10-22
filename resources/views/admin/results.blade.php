@extends('layouts.app')

@section('content')
    <div class="container py-5">

        <h2 class="text-center mb-4 fw-bold text-primary">
            🏆 Hasil Pemilihan Ketua OSIS
        </h2>

        @if($candidates->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                Belum ada kandidat atau voting belum dilakukan.
            </div>
        @else
            {{-- Tombol Export --}}
            <div class="text-end mb-3">
                <a href="{{ route('admin.vote.export') }}" class="btn btn-success">
                    📊 Export ke Excel
                </a>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 5%">No</th>
                                <th style="width: 15%">Foto</th>
                                <th style="width: 25%">Nama Kandidat</th>
                                <th style="width: 15%">Jumlah Suara</th>
                                <th style="width: 40%">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $index => $candidate)
                                @php
                                    $percent = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
                                @endphp
                                <tr>
                                    <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        @if($candidate->photo)
                                            <img src="{{ asset('storage/fotos/' . $candidate->photo) }}" alt="{{ $candidate->name }}"
                                                width="70" height="70" class="rounded-circle border">
                                        @else
                                            <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="fw-semibold">{{ $candidate->name }}</td>
                                    <td class="text-center fw-bold">{{ $candidate->votes_count }}</td>
                                    <td>
                                        <div class="progress" style="height: 25px;">
                                            <div class="progress-bar bg-success fw-semibold" role="progressbar"
                                                style="width: {{ $percent }}%;" aria-valuenow="{{ $percent }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                {{ number_format($percent, 2) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 text-end">
                        <strong class="fs-5 text-dark">
                            Total Suara: {{ $totalVotes }}
                        </strong>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection