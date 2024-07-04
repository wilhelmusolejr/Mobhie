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

        <div class="container-md container-fluid my-5 py-5">
            <div class="p-3 card d-flex flex-md-row gap-3 randomize">

                <div class="movie-image">
                    <img src="{{ asset('images/header-banner.jpg') }}" class="w-100 rounded">
                </div>

                <div class="movie-info d-flex flex-column">
                    <h3 class="movie-title align-self-center">Birds of the pray</h3>
                    <p class="card-text movie-descriptionn">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="movie-rate pb-3">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <a href="#" class="btn btn-primary text-dark align-self-center mt-auto">Randomize</a>
                </div>

            </div>
        </div>
    </main>

</x-layout>
