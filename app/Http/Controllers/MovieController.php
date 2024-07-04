<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller {

    private $tmdb_token;
    private $movie_url;
    private $description_limit = 50;
    private $title_limit = 10;
    private $movie_limit = 4;
    private $sections = [
        'popular' => [
            'url' => '/movie/popular?language=en-US&page=1',
            'endpoint' => '/movie/popular/page=1',
            'header' => 'Popular Movies',
            'movies' => [],
        ],
        'trending' => [
            'url' => '/trending/movie/day?language=en-US&page=1',
            'endpoint' => '/movie/trending/page=1',
            'header' => 'Trending Movies',
            'movies' => [],
        ],
        'top_rated' => [
            'url' => '/tv/top_rated?language=en-US&page=1',
            'endpoint' => '/movie/toprated/page=1',
            'header' => 'Top Rated Movies',
            'movies' => [],
        ],
    ];

    public function __construct() {
        $this->tmdb_token = config('services.tmdb.token');
        $this->movie_url = config('services.tmdb.movie_url');
    }

    public function index() {
        $section_copy = $this-> sections;

        foreach ($section_copy as $key => &$section) {
            $section['movies'] = $this->fetchMovies($section['url'], $this->movie_limit);
        }

        return view('welcome', [
            'section_movies' => $section_copy,
        ]);
    }

    public function toprated($page) {
        $target = 'top_rated';
        $pageNumber = substr($page, strpos($page, '=') + 1);

        $section_copy = $this-> getSection($target, $pageNumber);
        $section_copy['movies'] = $this->fetchMovies($section_copy['url']);
        $cleanedUrl = substr($section_copy['endpoint'], 0, strpos($section_copy['endpoint'], '='));

        $section_copy['current_page'] = $pageNumber;
        $section_copy['previous_url'] = $pageNumber > 1 ? $cleanedUrl . '=' . ($pageNumber - 1) : null;
        $section_copy['next_url'] = $cleanedUrl.'='.$pageNumber + 1;

        return view('list-movie', [
            'section' => $section_copy,
        ]);
    }

    public function trending($page) {
        $target = 'trending';
        $pageNumber = substr($page, strpos($page, '=') + 1);

        $section_copy = $this-> getSection($target, $pageNumber);
        $section_copy['movies'] = $this->fetchMovies($section_copy['url']);
        $cleanedUrl = substr($section_copy['endpoint'], 0, strpos($section_copy['endpoint'], '='));

        $section_copy['current_page'] = $pageNumber;
        $section_copy['previous_url'] = $pageNumber > 1 ? $cleanedUrl . '=' . ($pageNumber - 1) : null;
        $section_copy['next_url'] = $cleanedUrl.'='.$pageNumber + 1;

        return view('list-movie', [
            'section' => $section_copy,
        ]);
    }

    public function popular($page) {
        $target = 'popular';
        $pageNumber = substr($page, strpos($page, '=') + 1);

        $section_copy = $this-> getSection($target, $pageNumber);
        $section_copy['movies'] = $this->fetchMovies($section_copy['url']);
        $cleanedUrl = substr($section_copy['endpoint'], 0, strpos($section_copy['endpoint'], '='));

        $section_copy['current_page'] = $pageNumber;
        $section_copy['previous_url'] = $pageNumber > 1 ? $cleanedUrl . '=' . ($pageNumber - 1) : null;
        $section_copy['next_url'] = $cleanedUrl.'='.$pageNumber + 1;

        return view('list-movie', [
            'section' => $section_copy,
        ]);
    }

    public function showMovie($movie) {
        $movie_id = $movie;
        $movie_url = 'https://api.themoviedb.org/3/movie/'. $movie_id .'?language=en-US';
        $video_url = 'https://api.themoviedb.org/3/movie/'. $movie_id .'/similar?language=en-US&page=1';

        $response = Http::withToken($this -> tmdb_token)
        ->get($movie_url)
        ->json();

        $related = Http::withToken($this -> tmdb_token)
        ->get($video_url)
        ->json();

        if (isset($response['status_code']) && $response['status_code'] == 34) {
            abort(404, $response['status_message']);
        }

        $response['related'] = $this -> sliceMovie($related['results'], $this -> movie_limit );
        $this -> concatMovie($response['related']);

        return view('movie', [
            'movie' => $response
        ]);
    }

    private function fetchMovies($url, $limit = 0) {
        $response = Http::withToken($this->tmdb_token)
            ->get($this->movie_url . $url)
            ->json();

        $movies = $response['results'];
        if ($limit != 0) {
            $movies = $this -> sliceMovie($movies, $this -> movie_limit);
        }

        $this -> concatMovie($movies);

        return $movies;
    }

    private function sliceMovie($movies, $limit) {
        $movies = array_slice($movies, 0, $limit);
        return $movies;
    }

    private function concatMovie(&$movies) {
        foreach ($movies as &$movie) {
            $movie['star_rating'] = floor($movie['vote_average'] / 2);
            $movie['original_title'] = substr($movie['original_title'] ?? $movie['original_name'], 0, $this->title_limit) . (strlen($movie['original_title'] ?? $movie['original_name']) > $this->title_limit ? '...' : '');
            $movie['overview'] = substr($movie['overview'], 0, $this->description_limit) . (strlen($movie['overview']) > $this->description_limit ? '...' : '');
        }
    }

    private function getSection($target, $page) {
        $sections = [
            'popular' => [
                'url' => "/movie/popular?language=en-US&page=$page",
                'endpoint' => '/movie/popular/page=1',
                'header' => 'Popular Movies',
                'movies' => [],
            ],
            'trending' => [
                'url' => "/trending/movie/day?language=en-US&page=$page",
                'endpoint' => '/movie/trending/page=1',
                'header' => 'Trending Movies',
                'movies' => [],
            ],
            'top_rated' => [
                'url' => "/tv/top_rated?language=en-US&page=$page",
                'endpoint' => '/movie/toprated/page=1',
                'header' => 'Top Rated Movies',
                'movies' => [],
            ],
        ];

        return $sections[$target];
    }
}