
@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">

    @include('admin.menu')

    <h3>Kelola Film</h3>
    
@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <div style="color: red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<h4>Tambah Film</h4>

<form action="{{ route('admin.films.store') }}"
      method="POST"
      enctype="multipart/form-data"
      style="margin-bottom: 25px;">

    @csrf

    <div class="form-group">
        <label>Judul Film</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Sinopsis</label>
        <textarea name="sinopsis" class="form-control" rows="3" required></textarea>
    </div>

    <div class="form-group">
        <label>Tahun</label>
        <input type="number" name="year" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Genre</label>
        <select name="genre_id" class="form-control" required>
            <option value="">-- Pilih Genre --</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Poster Film</label>
        <input type="file" name="poster" class="form-control"
               accept="image/jpeg,image/png,image/webp" required>
    </div>

    <button type="submit" class="btn btn-warning">
        Tambah Film
    </button>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Poster</th>
                <th>Judul Film</th>
                <th>Genre</th>
                <th>Tahun</th>
                <th>Sinopsis</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($films as $film)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <img src="{{ asset($film->poster) }}"
                             alt="{{ $film->title }}"
                             width="70">
                    </td>

                    <td>{{ $film->title }}</td>

                    <td>{{ $film->genre->name ?? '-' }}</td>

                    <td>{{ $film->year }}</td>

                    <td>{{ $film->sinopsis }}</td>

<td>
    <details>
        <summary class="btn btn-primary btn-sm">Edit</summary>

        <form action="{{ route('admin.films.update', $film->id) }}"
              method="POST"
              enctype="multipart/form-data"
              style="margin-top: 10px; min-width: 200px;">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul Film</label>
                <input type="text" name="title"
                       class="form-control"
                       value="{{ $film->title }}" required>
            </div>

            <div class="form-group">
                <label>Sinopsis</label>
                <textarea name="sinopsis" class="form-control"
                          rows="3" required>{{ $film->sinopsis }}</textarea>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="year"
                       class="form-control"
                       value="{{ $film->year }}" required>
            </div>

            <div class="form-group">
                <label>Genre</label>
                <select name="genre_id" class="form-control" required>
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}"
                            {{ $film->genre_id == $genre->id ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Ganti Poster (Opsional)</label>
                <input type="file" name="poster"
                       class="form-control"
                       accept="image/jpeg,image/png,image/webp">
            </div>

            <button type="submit" class="btn btn-success btn-sm">
                Simpan Perubahan
            </button>
        </form>
    </details>
</td>

                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
