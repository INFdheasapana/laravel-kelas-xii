
@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">
    @include('admin.menu')

    <h3>Kelola Genre</h3>

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

    {{-- Form Tambah Genre --}}
    <form action="{{ route('admin.genres.store') }}" method="POST" style="margin-bottom: 20px;">
        @csrf
        <input type="text" name="name" class="form-control"
               placeholder="Nama genre baru" maxlength="45" required>
        <button type="submit" class="btn btn-warning">Tambah</button>
    </form>

    {{-- Tabel Genre --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Genre</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="text" name="name"
                                   value="{{ $genre->name }}"
                                   class="form-control"
                                   maxlength="45" required>

                            <button type="submit" class="btn btn-primary btn-sm">
                                Simpan
                            </button>
                        </form>
                    </td>

                    <td>
                        <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus genre ini?')">
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
