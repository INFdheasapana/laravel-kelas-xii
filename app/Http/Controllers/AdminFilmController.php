<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Http\Requests\StoreFilmRequest;
use App\Http\Requests\UpdateFilmRequest;
use Illuminate\Support\Facades\Storage;

class AdminFilmController extends Controller
{
    // Menampilkan daftar film
    public function index()
    {
        $films = Film::with('genre')->orderBy('title')->get();
        $genres = Genre::orderBy('name')->get();

        return view('admin.films', compact('films', 'genres'));
    }

    // Menyimpan film baru
    public function store(StoreFilmRequest $request)
    {
        $data = $request->validated();

        $poster = $request->file('poster')->store('images', 'public');

        $data['poster'] = 'storage/' . $poster;

        Film::create($data);

        return redirect()->route('admin.films')
            ->with('success', 'Film berhasil ditambahkan.');
    }

    // Mengubah data film
    public function update(UpdateFilmRequest $request, Film $film)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            // Hapus poster lama
            $oldPoster = str_replace('storage/', '', $film->poster);
            Storage::disk('public')->delete($oldPoster);

            // Simpan poster baru
            $poster = $request->file('poster')->store('images', 'public');
            $data['poster'] = 'storage/' . $poster;
        } else {
            // Gunakan poster lama
            unset($data['poster']);
        }

        $film->update($data);

        return redirect()->route('admin.films')
            ->with('success', 'Film berhasil diperbarui.');
    }
}
