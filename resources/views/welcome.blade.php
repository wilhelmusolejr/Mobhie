@php
    $movies = $section_movies['popular']['movies'];
    $randomKey = array_rand($movies);
    $randomMovie = $movies[$randomKey];
@endphp

<x-layout>


    {{-- HEADER --}}
    <x-header class="header-full header-semi-dark">
        @if ($randomMovie['backdrop_path'])
            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$randomMovie['backdrop_path'] }}</a>
        @else
            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$randomMovie['poster_path'] }}</a>
        @endif

        <div class="">
            <x-header-title>
                Watch movies for <br><span class="accent-color">FREE</span> now
            </x-header-title>
            <p class="">The films that we show are not illegal and of course in very good quality.</p>
            {{-- <x-btn-primary>Login</x-btn-primary> --}}
        </div>
    </x-header>

    {{-- Sponsor --}}
    <div class="container sponsor py-5 d-flex flex-wrap flex-md-nowrap justify-content-around align-items-center gap-5 text-center">
        <div class="">
            <img src="{{ asset('images/sponsor1.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor2.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor3.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor4.png') }}" alt="">
        </div>
    </div>

    <main class="py-5">

        @foreach ($section_movies as $section)
            <x-section-component
                header="{{ $section['header'] }}"
                endpoint="{{ $section['endpoint'] }}"
                :headerhide="false" >
                    @foreach($section['movies'] as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach
            </x-section-component>
            <hr>
        @endforeach

        <div class="container-md container-fluid my-5 py-5 randomize-parent">

            @php
                $totalSections = count($section_movies);
            @endphp

            @foreach ($section_movies as $sectionIndex => $section)
                @php
                    $sectionMoviesCount = count($section['movies']);
                    $isLastSection = ($loop->last);
                @endphp

                @foreach ($section['movies'] as $movieIndex => $movie)
                    @php
                        $isLastMovieInSection = ($movieIndex + 1 == $sectionMoviesCount);
                        $isEnd = $isLastSection && $isLastMovieInSection;
                    @endphp

                    <div class="p-3 card d-flex flex-md-row gap-3 randomize {{ $isEnd ? 'active' : 'd-none' }}">

                        @if ($movie['backdrop_path'])
                            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$movie['backdrop_path'] }}</a>
                        @else
                            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$movie['poster_path'] }}</a>
                        @endif

                        <div class="movie-image text-center">
                            <img src="{{ 'https://images.tmdb.org/t/p/w500' . $movie['poster_path'] }}" class="rounded" alt="{{ $movie['original_title'] }}">
                        </div>

                        <div class="movie-info d-flex flex-column">
                            <h3 class="movie-title align-self-center">{{ $movie['full_title'] }}</h3>
                            <p class="card-text movie-description">{{ $movie['full_overview'] }}</p>
                            <div class="movie-rate pb-3">
                                @for ($k = 0; $k < 5; $k++)
                                    @if ($k < $movie['star_rating'])
                                        <i class="fas fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <a href="{{ route('movie.show', $movie['id']) }}" class="btn btn-primary align-self-start">Learn More</a>
                        </div>

                    </div>
                @endforeach
            @endforeach

            <a href="#" class="btn btn-primary btn-randomize text-dark align-self-center mt-auto">Randomize</a>
        </div>
    </main>

</x-layout>
