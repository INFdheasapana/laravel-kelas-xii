
@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">

    @include('admin.menu')

    <h3>Kelola Cast</h3>

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

    <h4>Tambah Cast</h4>

    <form action="{{ route('admin.casts.store') }}"
          method="POST"
          style="margin-bottom: 25px;">

        @csrf

        <div class="form-group">
            <label>Nama Cast</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Umur</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-warning">
            Tambah Cast
        </button>
    </form>

    <h4>Daftar Cast</h4>

    
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Cast</th>
            <th>Umur</th>
            <th>Bio</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($casts as $cast)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cast->name }}</td>
                <td>{{ $cast->age }}</td>
                <td>{{ $cast->bio }}</td>

                <td style="white-space: nowrap;">
                    <details>
                        <summary class="btn btn-primary btn-sm">
                            Edit
                        </summary>

                        <form action="{{ route('admin.casts.update', $cast->id) }}"
                              method="POST"
                              style="margin-top: 10px; min-width: 200px;">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Nama Cast</label>
                                <input type="text" name="name"
                                       class="form-control"
                                       value="{{ $cast->name }}" required>
                            </div>

                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="age"
                                       class="form-control"
                                       value="{{ $cast->age }}" required>
                            </div>

                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control"
                                          rows="3" required>{{ $cast->bio }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-sm">
                                Simpan Perubahan
                            </button>
                        </form>
                    </details>
                    <form action="{{ route('admin.casts.destroy', $cast->id) }}"
      method="POST"
      onsubmit="return confirm('Yakin ingin menghapus cast ini?')"
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
