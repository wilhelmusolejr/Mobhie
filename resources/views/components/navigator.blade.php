<nav class="navbar fixed-top py-4">
    <div class="container-fluid px-5 justify-content-between">
        <a class="logo text-uppercase text-decoration-none" href="{{ route('home') }}">Mobhie</a>

        <div class="d-lg-flex d-none navbar-parent">
        {{-- <div class=""> --}}
            <ul class="navbar-nav d-flex flex-row gap-3">
              <li class="nav-item">
                <a class="nav-link active" href="{{ route('popular', 'page=1') }}">Popular</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('trending', 'page=1') }}">Trending</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('toprated', 'page=1') }}">Top Rated</a>
              </li>
            </ul>
        </div>

        <div class="align-items-center gap-3 z-1 item-third d-lg-flex d-none">
            <div class="search-bar">
            {{-- <div class=""> --}}
                <i class="fa-solid fa-magnifying-glass"></i>
                <input class="rounded" type="text">
            </div>

            <div class="user-profile ">
            {{-- <div class="user-profile"> --}}
                <img src="{{ asset('images/dummy.jpg') }}" class="rounded-circle d-none" alt="">
                <a class="ms-2 text-decoration-none" href="#">Logout</a>
            </div>
        </div>

        <div class="bars text-light d-lg-none d-block z-1">
            {{-- <div class="bars text-light"> --}}
                <i class="fa-solid fa-bars"></i>
            </div>
    </div>
</nav>
