<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    /**
     * Tampilkan daftar semua kandidat (Admin)
     */
    public function index()
    {
        $candidates = Candidate::all();
        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Form untuk menambah kandidat baru
     */
    public function create()
    {
        return view('admin.candidates.create');
    }

    /**
     * Simpan data kandidat baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        Candidate::create($request->only(['name', 'vision', 'mission']));

        return redirect()->route('candidates.index')
                         ->with('success', 'Kandidat berhasil ditambahkan!');
    }

    /**
     * Form untuk edit kandidat
     */
    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.edit', compact('candidate'));
    }

    /**
     * Proses update kandidat
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'mission' => 'required|string',
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->update($request->only(['name', 'vision', 'mission']));

        return redirect()->route('candidates.index')
                         ->with('success', 'Kandidat berhasil diperbarui!');
    }

    /**
     * Hapus kandidat
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();

        return redirect()->route('candidates.index')
                         ->with('success', 'Kandidat berhasil dihapus!');
    }
}
