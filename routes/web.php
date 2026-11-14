<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FilmController,
    AuthController,
    AdminUserController,
    AdminGenreController,
    AdminFilmController,
    AdminPeranController,
    AdminCastController,
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

    // Admin User
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users');

    // Admin Genre
    Route::get('/admin/genres', [AdminGenreController::class, 'index'])
        ->name('admin.genres');
    Route::post('/admin/genres', [AdminGenreController::class, 'store'])
        ->name('admin.genres.store');
    Route::put('/admin/genres/{genre}', [AdminGenreController::class, 'update'])
        ->name('admin.genres.update');
    Route::delete('/admin/genres/{genre}', [AdminGenreController::class, 'destroy'])
        ->name('admin.genres.destroy');

    // Admin Cast
    Route::get('/admin/casts', [AdminCastController::class, 'index'])
        ->name('admin.casts');
    Route::post('/admin/casts', [AdminCastController::class, 'store'])
        ->name('admin.casts.store');
    Route::put('/admin/casts/{cast}', [AdminCastController::class, 'update'])
        ->name('admin.casts.update');
    Route::delete('/admin/casts/{cast}', [AdminCastController::class, 'destroy'])
        ->name('admin.casts.destroy');
        // Admin Peran
    Route::get('/admin/perans', [AdminPeranController::class, 'index'])
        ->name('admin.perans');
    Route::post('/admin/perans', [AdminPeranController::class, 'store'])
        ->name('admin.perans.store');
    Route::put('/admin/perans/{peran}', [AdminPeranController::class, 'update'])
        ->name('admin.perans.update');
    Route::delete('/admin/perans/{peran}', [AdminPeranController::class, 'destroy'])
        ->name('admin.perans.destroy');

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

// TUGAS: profil user
Route::middleware('cekrole:user')->group(function () {
    Route::get('/profil', [ProfileController::class, 'saya'])->name('profil');
    Route::put('/profil', [ProfileController::class, 'perbarui'])->name('profil.update');
});
