<div class="header">
  <div class="container">
    <div class="w3layouts_logo">
      <a href="{{ route('home') }}"><h1>One<span>Movies</span></h1></a>
    </div>
    <div class="w3_search">
      <form action="#" method="post">
        <input type="text" name="Search" placeholder="Search" required="">
        <input type="submit" value="Go">
      </form>
    </div>
    <div class="w3l_sign_in_register">
      <ul>
        {{-- TUGAS: belum login tampil Login, sudah login tampil nama user + Logout --}}
        @guest
          <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
        @endguest
        @auth
          {{-- TUGAS: user biasa -> Profil Saya, admin -> halaman admin --}}
          @if (Auth::user()->role?->name === 'user')
            <li><a href="{{ route('profil') }}">{{ Auth::user()->name }}</a></li>
          @else
            <li><a href="{{ route('admin.users') }}">{{ Auth::user()->name }}</a></li>
          @endif
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">
              @csrf
            </form>
          </li>
        @endauth
      </ul>
    </div>
    <div class="clearfix"> </div>
  </div>
</div>