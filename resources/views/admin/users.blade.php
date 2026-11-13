@extends('templates.index')

@section('content')
<div class="container" style="padding: 30px 0;">
  @include('admin.menu')

  <h3>Daftar User</h3>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role->name ?? '-' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection