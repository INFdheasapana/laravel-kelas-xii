<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class AdminCastController extends Controller
{
    // Menampilkan daftar cast
    public function index()
    {
        $casts = Cast::orderBy('name')->get();

        return view('admin.casts', compact('casts'));
    }

    // Menambahkan cast baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'bio' => 'required|string',
        ]);

        Cast::create($data);

        return redirect()->route('admin.casts')
            ->with('success', 'Cast berhasil ditambahkan.');
    }

    // Mengubah data cast
    public function update(Request $request, Cast $cast)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'bio' => 'required|string',
        ]);

        $cast->update($data);

        return redirect()->route('admin.casts')
            ->with('success', 'Cast berhasil diperbarui.');
    }

    // Menghapus data cast
    public function destroy(Cast $cast)
    {
         $cast->delete();

        return redirect()->route('admin.casts')
            ->with('success', 'Cast berhasil dihapus.');
    }

}