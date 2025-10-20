<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;

class VoteController extends Controller
{
    // Tampilkan daftar kandidat untuk voting
    public function index()
    {
        $candidates = Candidate::all();
        return view('vote.index', compact('candidates'));
    }

    // Simpan vote
    public function store(Request $request)
    {
        $user = auth()->user();

        if($user->has_voted) {
            return redirect()->back()->with('error', 'Kamu sudah memilih!');
        }

        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
        ]);

        $user->update(['has_voted' => true]);

        return redirect()->route('vote.result')->with('success', 'Voting berhasil!');
    }

    // Tampilkan hasil voting
    public function result()
    {
        $results = Candidate::withCount('votes')->get();
        return view('vote.result', compact('results'));
    }
}
