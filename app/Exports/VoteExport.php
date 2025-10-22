<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class VoteExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    public function collection()
    {
        return Candidate::withCount('votes')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Kandidat',
            'Jumlah Suara',
            'Persentase (%)',
            'Dibuat Pada',
        ];
    }

    public function map($candidate): array
    {
        $totalVotes = Candidate::withCount('votes')->get()->sum('votes_count');
        $percent = $totalVotes > 0 ? round(($candidate->votes_count / $totalVotes) * 100, 2) : 0;

        return [
            $candidate->id,
            $candidate->name,
            $candidate->votes_count,
            $percent . '%',
            $candidate->created_at->format('d-m-Y H:i'),
        ];
    }
}
