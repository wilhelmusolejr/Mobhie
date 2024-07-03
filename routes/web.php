<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $base_url = 'https://api.themoviedb.org/3';

    $description_limit = 50;
    $title_limit = 10;
    $movie_limit = 4;

    $popular = Http::withToken(config('services.tmdb.token'))
        ->get($base_url.'/movie/popular')
        ->json();

    $trending = Http::withToken(config('services.tmdb.token'))
    ->get($base_url.'/trending/movie/day?language=en-US')
    ->json();

    $top_rated = Http::withToken(config('services.tmdb.token'))
    ->get($base_url.'/tv/top_rated?language=en-US&page=1')
    ->json();

    // Get only the first 5 results
    $popularMovies = array_slice($popular['results'], 0, $movie_limit);
    $trendingMovies = array_slice($trending['results'], 0, $movie_limit);
    $topRatedMovies = array_slice($top_rated['results'], 0, $movie_limit);

    foreach ($popularMovies as &$movie) {
        $movie['star_rating'] = floor($movie['vote_average'] / 2);
        $movie['original_title'] = substr($movie['original_title'], 0, $title_limit) . (strlen($movie['original_title']) > $title_limit ? '...' : '');
        $movie['overview'] = substr($movie['overview'], 0, $description_limit) . (strlen($movie['overview']) > $description_limit ? '...' : '');
    }

    foreach ($trendingMovies as &$movie) {
        $movie['star_rating'] = floor($movie['vote_average'] / 2);
        $movie['original_title'] = substr($movie['original_title'], 0, $title_limit) . (strlen($movie['original_title']) > $title_limit ? '...' : '');
        $movie['overview'] = substr($movie['overview'], 0, $description_limit) . (strlen($movie['overview']) > $description_limit ? '...' : '');
    }

    foreach ($topRatedMovies as &$movie) {
        $movie['star_rating'] = floor($movie['vote_average'] / 2);
        $movie['original_title'] = substr($movie['original_name'], 0, $title_limit) . (strlen($movie['original_name']) > $title_limit ? '...' : '');
        $movie['overview'] = substr($movie['overview'], 0, $description_limit) . (strlen($movie['overview']) > $description_limit ? '...' : '');
    }

    return view('welcome', [
        'popular_movies' => $popularMovies,
        'trending_movies' => $trendingMovies,
        'top_rated_movies' => $topRatedMovies
    ]);
});

Route::get('/{movie}', function () {
    return view('movie');
});