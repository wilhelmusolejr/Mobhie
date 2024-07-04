@php
    $keywords = [
        'adventure', 'action', 'comedy', 'drama', 'fantasy', 'horror', 'mystery', 'romance', 'thriller', 'sci-fi',
        'documentary', 'animation', 'biography', 'crime', 'family', 'history', 'musical', 'sport', 'war', 'western',
        'indie', 'superhero', 'vampire', 'zombie', 'alien', 'robot', 'magic', 'wizard', 'sorcery', 'dragon',
        'mythology', 'supernatural', 'paranormal', 'detective', 'spy', 'heist', 'revenge', 'disaster', 'post-apocalyptic', 'dystopian',
        'fairy-tale', 'historical', 'political', 'psychological', 'satire', 'survival', 'time-travel', 'urban', 'epic', 'tragic',
        'cultural', 'environmental', 'technological', 'medieval', 'renaissance', 'victorian', 'steampunk', 'cyberpunk', 'noir', 'road',
        'coming-of-age', 'heroic', 'journey', 'saga', 'classic', 'modern', 'international', 'independent', 'festival', 'award-winning',
        'based-on-true-story', 'short-film', 'feature-film', 'blockbuster', 'franchise', 'series', 'sequel', 'prequel', 'reboot', 'spin-off',
        'b-movie', 'cult-classic', 'silent-film', 'black-and-white', 'experimental', 'avant-garde', 'arthouse', 'low-budget', 'high-budget', 'crowdfunded'
    ];

    $randomKeyword = $keywords[array_rand($keywords)];
@endphp

<nav class="navbar fixed-top py-4">
    <div class="container-fluid px-5 justify-content-between">
        <a class="logo text-uppercase text-decoration-none" href="{{ route('home') }}">Mobhie</a>

        <div class="d-lg-flex d-none navbar-parent">
            <ul class="navbar-nav d-flex flex-row gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('popular') ? 'active' : '' }}" href="{{ route('popular', 'page=1') }}">Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('trending') ? 'active' : '' }}" href="{{ route('trending', 'page=1') }}">Trending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('toprated') ? 'active' : '' }}" href="{{ route('toprated', 'page=1') }}">Top Rated</a>
                </li>
            </ul>
        </div>

        <div class="align-items-center gap-3 z-1 item-third d-lg-flex d-none">
            <div class="search-bar">
            {{-- <div class=""> --}}
                <i class="fa-solid fa-magnifying-glass"></i>
                <form action="{{ route('search') }}" method="get">
                    <input class="rounded" name='string' type="text" placeholder="{{ $randomKeyword }}">
                    <input class="rounded" name='page' type="hidden" value="1">
                </form>
            </div>

            <div class="user-profile ">
            {{-- <div class="user-profile"> --}}
                <img src="{{ asset('images/dummy.jpg') }}" class="rounded-circle d-none" alt="">
                <a class="ms-2 text-decoration-none d-none" href="#">Logout</a>
            </div>
        </div>

        <div class="bars text-light d-lg-none d-block z-1">
                <i class="fa-solid fa-bars"></i>
            </div>
    </div>
</nav>
