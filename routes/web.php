<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $movie_url = config('services.tmdb.movie_url');
    $image_url = config('services.tmdb.image_url');
    $tmdb_token = config('services.tmdb.token');

    $description_limit = 50;
    $title_limit = 10;
    $movie_limit = 4;

    $sections = [
        'popular' => [
            'url' => '/movie/popular',
            'header' => 'Popular Movies',
            'movies' => [],
        ],
        'trending' => [
            'url' => '/trending/movie/day?language=en-US',
            'header' => 'Trending Movies',
            'movies' => [],
        ],
        'top_rated' => [
            'url' => '/tv/top_rated?language=en-US&page=1',
            'header' => 'Top Rated Movies',
            'movies' => [],
        ],
    ];

    foreach ($sections as $key => &$section) {
        $response = Http::withToken($tmdb_token)
            ->get($movie_url . $section['url'])
            ->json();

        $movies = array_slice($response['results'], 0, $movie_limit);

        foreach ($movies as &$movie) {
            $movie['star_rating'] = floor($movie['vote_average'] / 2);
            $movie['original_title'] = substr($movie['original_title'] ?? $movie['original_name'], 0, $title_limit) . (strlen($movie['original_title'] ?? $movie['original_name']) > $title_limit ? '...' : '');
            $movie['overview'] = substr($movie['overview'], 0, $description_limit) . (strlen($movie['overview']) > $description_limit ? '...' : '');
        }

        $section['movies'] = $movies; // Save processed movies back into the section array
    }

    return view('welcome', [
        'section_movies' => $sections,
    ]);
}) -> name('home');

Route::get('/movie/{movie}', function ($movie) {
    $movie_id = $movie;

    $movie_id = 'https://api.themoviedb.org/3/movie/'.$movie_id.'?language=en-US';
    $tmdb_token = config('services.tmdb.token');

    $response = Http::withToken($tmdb_token)
    ->get($movie_id)
    ->json();

    // dd($response);

    return view('movie', [
        'movie' => $response
    ]);
});