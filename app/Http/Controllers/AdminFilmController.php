<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use App\Http\Requests\StoreFilmRequest;
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
}
