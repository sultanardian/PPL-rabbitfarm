<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}"><img src="/img/logo02.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        @guest
        <li class="nav-item">
          <a class="nav-link @yield('beranda-active')" href="{{ url('/') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('login-active')" href="{{ route('login') }}">Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @yield('register-active')" href="{{ route('register') }}">Daftar</a>
        </li>
        @else
          <li class="nav-item">
            <a class="nav-link @yield('beranda-active')" href="{{ route('home') }}">Beranda</a>
          </li>
          @if(Auth::user()->vendor == '1')
            <li class="nav-item">
              <a class="nav-link @yield('pesanan-active')" href="{{ route('order.index') }}">Ajukan permintaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('buyer_profile.index') }}">Profil</a>
            </li>
          @elseif(Auth::user()->vendor == '2')
            <li class="nav-item">
              <a class="nav-link @yield('tawaran-active')" href="{{ route('confirmed_offer.index') }}">Lihat tawaran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('stok-active')" href="{{ route('stock.index') }}">Persediaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link @yield('nelayan-active')" href="{{ route('fisher.index') }}">Nelayan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin_profile.index') }}">Profil</a>
            </li>
          @endif
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
            </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>