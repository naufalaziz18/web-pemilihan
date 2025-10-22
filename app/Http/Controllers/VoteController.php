<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    // 🔹 Menampilkan daftar kandidat untuk user
    public function showCandidates()
    {
        $candidates = Candidate::all();
        $hasVoted = Vote::where('user_id', Auth::id())->exists();

        return view('vote.index', compact('candidates', 'hasVoted'));
    }

    // 🔹 Proses vote
    public function submit($id)
    {
        $user = Auth::user();

        // Cegah user voting dua kali
        if (Vote::where('user_id', $user->id)->exists()) {
            return redirect()->route('vote')->with('error', 'Kamu sudah melakukan voting!');
        }

        // Simpan vote
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $id,
        ]);

        return redirect()->route('vote')->with('success', 'Voting berhasil, terima kasih telah berpartisipasi!');
    }

    // 🔹 Hasil voting (admin dan user bisa lihat)
    public function result()
    {
        $results = Candidate::withCount('votes')->get();
        $totalVotes = $results->sum('votes_count');

        return view('admin.results', compact('results', 'totalVotes'));
    }
}
