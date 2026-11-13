<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminGenreController extends Controller
{
    // Daftar genre
    public function index()
    {
        $genres = Genre::orderBy('name')->get();

        return view('admin.genres', compact('genres'));
    }

    // Tambah genre baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        $genre = new Genre();
        $genre->name = $data['name'];
        $genre->save();

        return back()->with('success', 'Genre berhasil ditambahkan.');
    }

    // Ubah nama genre
    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:45'],
        ]);

        $genre->name = $data['name'];
        $genre->save();

        return back()->with('success', 'Genre berhasil diubah.');
    }

    // Hapus genre (hanya kalau tidak dipakai film)
    public function destroy(Genre $genre)
    {
        if (Film::where('genre_id', $genre->id)->exists()) {
            return back()->withErrors(['genre' => 'Genre "' . $genre->name . '" masih dipakai oleh film, jadi tidak bisa dihapus.']);
        }

        $genre->delete();

        return back()->with('success', 'Genre berhasil dihapus.');
    }
}