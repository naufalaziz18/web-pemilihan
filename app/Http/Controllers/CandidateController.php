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
            'name' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan foto ke folder public/fotos
        $path = null;
        if ($request->hasFile('photo')) {
            // Simpan di storage/app/public/photos
            $path = $request->file('photo')->store('photos', 'public');
        }
        $photoPath = $path;

        // Simpan data ke database
        Candidate::create([
            'name' => $request->name,
            'vision' => $request->vision,
            'mission' => $request->mission,
            'photo' => $photoPath,
        ]);

        return redirect()->route('candidates.index')->with('success', 'Kandidat berhasil ditambahkan');

        
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
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'name' => 'required',
            'vision' => 'required',
            'mission' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
/*************  ✨ Windsurf Command ⭐  *************/
/**
 * Menghapus kandidat berdasarkan id yang diberikan
 *
 * @param int $id id kandidat yang ingin dihapus
 *
 * @return \Illuminate\Http\RedirectResponse
 */
/*******  e58bfc7a-3a79-4f4e-8fc5-10416c5d7682  *******/            'vision' => $request->vision,
            'mission' => $request->mission,
        ];

        // Jika ada foto baru, simpan dan hapus foto lama
        if ($request->hasFile('photo')) {
            if ($candidate->photo && file_exists(storage_path('app/public/' . $candidate->photo))) {
                unlink(storage_path('app/public/' . $candidate->photo));
            }
            $data['photo'] = $request->file('photo')->store('fotos', 'public');
        }

        $candidate->update($data);

        return redirect()->route('candidates.index')->with('success', 'Kandidat berhasil diupdate');
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
