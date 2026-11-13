@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">
  <ol class="breadcrumb">
    <li><a href="{{ route('home') }}">Home</a></li>
    <li class="active">Profil Saya</li>
  </ol>

  <h3>Profil Saya</h3>

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

  <form action="{{ route('profil.update') }}" method="post" style="max-width: 500px;">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>

    <div class="form-group">
      <label>Umur</label>
      <input type="number" name="umur" class="form-control" value="{{ old('umur', $profile->umur) }}" required>
    </div>

    <div class="form-group">
      <label>Bio</label>
      <textarea name="bio" class="form-control" rows="3" required>{{ old('bio', $profile->bio) }}</textarea>
    </div>

    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $profile->alamat) }}</textarea>
    </div>

    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
  </form>
</div>
@endsection