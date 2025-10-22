<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function dashboard()
    {
        $totalCandidates = Candidate::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalVotes = Vote::count();

        return view('admin.dashboard', compact('totalCandidates', 'totalUsers', 'totalVotes'));
    }

    /**
     * Tampilkan hasil voting.
     */
    public function results()
    {
        $candidates = Candidate::withCount('votes')->get();
        $totalVotes = Vote::count();

        return view('admin.results', compact('candidates', 'totalVotes'));
    }
}
