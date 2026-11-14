<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
    AuthController,
    AdminUserController,
    AdminGenreController,
    AdminFilmController,
    KritikController,
    ProfileController,
};

Route::get('/', [FilmController::class, 'movieHome'])->name('home');
Route::get('/movies', [FilmController::class, 'movies'])->name('movies');
Route::get('/movies/{film}', [FilmController::class, 'show'])->name('movies.show');
Route::get('/movies/genre/{genre}', [FilmController::class, 'moviesByGenre'])->name('genre');

Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// TUGAS: halaman khusus admin
Route::middleware('cekrole:admin')->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users');

    Route::get('/admin/genres', [AdminGenreController::class, 'index'])->name('admin.genres');
    Route::post('/admin/genres', [AdminGenreController::class, 'store'])->name('admin.genres.store');
    Route::put('/admin/genres/{genre}', [AdminGenreController::class, 'update'])->name('admin.genres.update');
    Route::delete('/admin/genres/{genre}', [AdminGenreController::class, 'destroy'])->name('admin.genres.destroy');
    
    // Admin Film
    Route::get('/admin/films', [AdminFilmController::class, 'index'])
        ->name('admin.films');
    Route::post('/admin/films', [AdminFilmController::class, 'store'])
        ->name('admin.films.store');
    Route::put('/admin/films/{film}', [AdminFilmController::class, 'update'])
        ->name('admin.films.update');
    Route::delete('/admin/films/{film}', [AdminFilmController::class, 'destroy'])
    ->name('admin.films.destroy');

});

Route::post('/movies/{film}/kritik', [KritikController::class, 'store'])
    ->middleware('cekrole:user')
    ->name('kritik.store');

// TUGAS: profil user (lihat dan edit profil sendiri)
Route::middleware('cekrole:user')->group(function () {
    Route::get('/profil', [ProfileController::class, 'saya'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'perbarui'])->name('profil.update');
});