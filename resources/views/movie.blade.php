<x-layout>
    @section('title', "MOBHIE | ".$movie['original_title'])

    {{-- HEADER --}}
    <x-header class="header-full header-dark">
        @if ($movie['backdrop_path'])
            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$movie['backdrop_path'] }}</a>
        @else
            <a href="#" class="d-none backdrop_link">{{ 'https://images.tmdb.org/t/p/w500'.$movie['poster_path'] }}</a>
        @endif

        <div class="container header-content d-flex flex-lg-nowrap flex-wrap align-items-center gap-3">
            <div class="text-center movie-poster w-100">
                <img src="{{ 'https://images.tmdb.org/t/p/w500'.$movie['poster_path'] }}" class="rounded text-center" alt="{{ $movie['original_title'] }}">
            </div>
            <div class="">
                <h1 class="fs-1 fw-bold text-uppercase">{{ $movie['original_title'] }}</h1>
                <p class="">{{ $movie['overview'] }}</p>

                <div class="text-uppercase">
                    <x-btn-primary><i class="fa-solid fa-plus"></i> Add to wishlist</x-btn-primary>
                    <x-btn-primary><i class="fa-solid fa-play"></i> Play trailer</x-btn-primary>
                </div>
            </div>
        </div>
    </x-header>

    {{-- Sponsor --}}
    <div class="container sponsor py-5 d-flex flex-wrap flex-md-nowrap justify-content-around align-items-center gap-5 text-center">
        @foreach ($movie['production_companies'] as $production)
        <div class="">
            <img src="{{ 'https://images.tmdb.org/t/p/w500'.$production['logo_path'] }}" alt="{{ $production['name'] }}">
        </div>
        @endforeach
    </div>

    <main class="py-5">

        <div class="container text-light py-3">
            <h3 class="text-center py-3">" {{ $movie['tagline'] }} "</h3>

            @empty(!$movie['video'])
            <div class="text-center mb-5">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="{{ $movie['video'] }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
            @endempty

            <div class="card my-3">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <div class="card-body">
                            <h5 class="card-title">{{ $movie['original_title'] }}</h5>
                            <div style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Tagline</th>
                                            <td>{{ $movie['tagline'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Overview</th>
                                            <td>{{ $movie['overview'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Release Date</th>
                                            <td>{{ $movie['release_date'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Runtime</th>
                                            <td>{{ $movie['runtime'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Genres</th>
                                            <td>{{ implode(', ', array_column($movie['genres'], 'name')) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Production Companies</th>
                                            <td>{{ implode(', ', array_column($movie['production_companies'], 'name')) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Production Countries</th>
                                            <td>{{ implode(', ', array_column($movie['production_countries'], 'name')) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Vote Average</th>
                                            <td>{{ $movie['vote_average'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Vote Count</th>
                                            <td>{{ $movie['vote_count'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Popularity</th>
                                            <td>{{ $movie['popularity'] }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Homepage</th>
                                            <td><a target="_blank" href="{{ $movie['homepage'] }}">{{ $movie['homepage'] }}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @empty(!$movie['related'])
        <x-section-component
            header="Similar movies"
            endpoint="{{ 'xx' }}"
            :headerhide="false" >
                @foreach($movie['related'] as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
        </x-section-component>
        @endempty

    </main>
</x-layout>
