<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VoteExport;

class VoteController extends Controller
{
    public function __construct()
    {
        // Hanya halaman tertentu yang bisa diakses tanpa login
        $this->middleware('auth')->except(['showCandidates', 'store', 'result']);
    }

    // 🔹 Tampilkan daftar kandidat untuk voting
    public function showCandidates()
    {
        $candidates = Candidate::all();
        return view('vote.index', compact('candidates'));
    }

    // 🔹 Simpan suara (vote)
    public function store(Request $request)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $candidateId = $request->candidate_id;
        $user = $request->user();

        // Buat identifier unik untuk pengunjung (guest)
        $identifier = session()->get('voter_id');
        if (!$identifier) {
            $identifier = (string) Str::uuid();
            session()->put('voter_id', $identifier);
            cookie()->queue('voter_id', $identifier, 60 * 24 * 365); // berlaku 1 tahun
        }

        $ip = $request->ip();
        $ua = substr($request->userAgent() ?? '', 0, 500);

        // Cek apakah sudah pernah vote
        $alreadyVoted = Vote::where(function ($q) use ($user, $identifier) {
                if ($user) {
                    $q->where('user_id', $user->id);
                } else {
                    $q->where('identifier', $identifier);
                }
            })
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'Kamu sudah memberikan suara sebelumnya.');
        }

        // Simpan suara
        Vote::create([
            'candidate_id' => $candidateId,
            'user_id' => $user ? $user->id : null,
            'identifier' => $identifier,
            'ip' => $ip,
            'user_agent' => $ua,
        ]);

        return back()->with('success', 'Terima kasih! Suara kamu sudah tercatat.');
    }

    // 🔹 Tampilkan hasil voting
    public function result()
    {
        $candidates = Candidate::withCount('votes')->get();
        $totalVotes = $candidates->sum('votes_count');

        return view('vote.result', compact('candidates', 'totalVotes'));
    }

    // 🔹 Ekspor hasil voting ke Excel
    public function export()
    {
        return Excel::download(new VoteExport, 'hasil_voting.xlsx');
    }
}
