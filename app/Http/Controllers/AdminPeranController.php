<?php

namespace App\Http\Controllers;

use App\Models\Peran;
use App\Models\Film;
use App\Models\Cast;
use Illuminate\Http\Request;

class AdminPeranController extends Controller
{
    // Menampilkan daftar peran
    public function index()
    {
        $perans = Peran::with(['film', 'cast'])->get();
        $films = Film::orderBy('title')->get();
        $casts = Cast::orderBy('name')->get();

        return view('admin.perans', compact('perans', 'films', 'casts'));
    }

    // Menambahkan peran baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'actor' => 'required|string',
            'film_id' => 'required|exists:films,id',
            'cast_id' => 'required|exists:casts,id',
        ]);

        Peran::create($data);

        return redirect()->route('admin.perans')
            ->with('success', 'Peran berhasil ditambahkan.');
    }

    // Mengubah data peran
    public function update(Request $request, Peran $peran)
    {
        $data = $request->validate([
            'actor' => 'required|string',
            'film_id' => 'required|exists:films,id',
            'cast_id' => 'required|exists:casts,id',
        ]);

        $peran->update($data);

        return redirect()->route('admin.perans')
            ->with('success', 'Peran berhasil diperbarui.');
    }

    // Menghapus data peran
    public function destroy(Peran $peran)
    {
        $peran->delete();

        return redirect()->route('admin.perans')
            ->with('success', 'Peran berhasil dihapus.');
    }
}
