<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProfileRequest $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }

    // TUGAS: tampilkan profil milik user yang sedang login
    public function saya(Request $request)
    {
        $user = $request->user();
        $profile = $this->ambilProfil($user);

        return view('components.profile', compact('user', 'profile'));
    }

    // TUGAS: simpan perubahan profil milik user yang sedang login
    public function perbarui(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'between:1,150'],
            'bio' => ['required', 'string'],
            'alamat' => ['required', 'string'],
        ]);

        $user = $request->user();
        $profile = $this->ambilProfil($user);

        $user->update(['name' => $data['name']]);
        $profile->update([
            'umur' => $data['umur'],
            'bio' => $data['bio'],
            'alamat' => $data['alamat'],
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // TUGAS: ambil profil user, kalau belum ada dibuatkan otomatis
    private function ambilProfil($user)
    {
        $profile = $user->profile;

        if (!$profile) {
            $profile = Profile::create([
                'umur' => 1,
                'bio' => '-',
                'alamat' => '-',
            ]);
            $user->update(['profile_id' => $profile->id]);
        }

        return $profile;
    }
}