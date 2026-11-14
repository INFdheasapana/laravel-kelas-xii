@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">

    @include('admin.menu')

    <h3>Kelola Peran</h3>

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

    <h4>Tambah Peran</h4>

    <form action="{{ route('admin.perans.store') }}"
          method="POST"
          style="margin-bottom: 25px;">

        @csrf

        <div class="form-group">
            <label>Nama Peran / Karakter</label>
            <input type="text" name="actor" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Film</label>
            <select name="film_id" class="form-control" required>
                <option value="">-- Pilih Film --</option>
                @foreach ($films as $film)
                    <option value="{{ $film->id }}">
                        {{ $film->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Cast</label>
            <select name="cast_id" class="form-control" required>
                <option value="">-- Pilih Cast --</option>
                @foreach ($casts as $cast)
                    <option value="{{ $cast->id }}">
                        {{ $cast->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">
            Tambah Peran
        </button>
    </form>

    <h4>Daftar Peran</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peran</th>
                <th>Film</th>
                <th>Cast</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($perans as $peran)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $peran->actor }}</td>
                    <td>{{ $peran->film->title ?? '-' }}</td>
                    <td>{{ $peran->cast->name ?? '-' }}</td>

                    <td style="white-space: nowrap;">
                        <details>
                            <summary class="btn btn-primary btn-sm">
                                Edit
                            </summary>

                            <form action="{{ route('admin.perans.update', $peran->id) }}"
                                  method="POST"
                                  style="margin-top: 10px; min-width: 200px;">

                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Peran</label>
                                    <input type="text" name="actor"
                                           value="{{ $peran->actor }}"
                                           class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Film</label>
                                    <select name="film_id" class="form-control" required>
                                        @foreach ($films as $film)
                                            <option value="{{ $film->id }}"
                                                {{ $peran->film_id == $film->id ? 'selected' : '' }}>
                                                {{ $film->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Cast</label>
                                    <select name="cast_id" class="form-control" required>
                                        @foreach ($casts as $cast)
                                            <option value="{{ $cast->id }}"
                                                {{ $peran->cast_id == $cast->id ? 'selected' : '' }}>
                                                {{ $cast->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success btn-sm">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </details>

                        <form action="{{ route('admin.perans.destroy', $peran->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus peran ini?')"
                              style="display: inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
