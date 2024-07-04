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
            $this -> concatMovie($section['movies']);
        }

        return view('welcome', [
            'section_movies' => $section_copy,
        ]);
    }

    public function toprated($page) {
        $target = 'top_rated';

        $response = $this -> list_init($target, $page);

        return view('list-movie', [
            'section' => $response,
        ]);
    }

    public function trending($page) {
        $target = 'trending';

        $response = $this -> list_init($target, $page);

        return view('list-movie', [
            'section' => $response,
        ]);
    }

    public function popular($page) {
        $target = 'popular';

        $response = $this -> list_init($target, $page);

        return view('list-movie', [
            'section' => $response,
        ]);
    }

    public function showMovie($movie) {
        $movie_id = $movie;
        $movie_url = 'https://api.themoviedb.org/3/movie/'. $movie_id .'?language=en-US';
        $related_url = 'https://api.themoviedb.org/3/movie/'. $movie_id .'/similar?language=en-US&page=1';
        $video_url = 'https://api.themoviedb.org/3/movie/'. $movie_id .'/videos?language=en-US';

        $response = Http::withToken($this -> tmdb_token)
        ->get($movie_url)
        ->json();

        $related = Http::withToken($this -> tmdb_token)
        ->get($related_url)
        ->json();

        $video = Http::withToken($this -> tmdb_token)
        ->get($video_url)
        ->json();

        if (isset($response['status_code']) && $response['status_code'] == 34) {
            abort(404, $response['status_message']);
        }

        $response['related'] = $this -> sliceMovie($related['results'], $this -> movie_limit );

        if (empty($video['results'])) {
            $response['video'] = [];
        } else {
            $response['video'] = 'https://www.youtube.com/embed/'.$video['results'][0]['key'];
        }

        $this -> concatMovie($response['related']);


        return view('movie', [
            'movie' => $response
        ]);
    }

    public function search(Request $request) {
        $response = [];

        $string = $request->input('string');
        $pageNumber = $request->input('page');

        $search_url = "/search/movie?query=".$string."&include_adult=false&language=en-US&page=$pageNumber";

        $response['movies'] = $this -> fetchMovies($search_url, $limit = 0);
        $response['header'] = $string;

        $response['endpoint'] = request()->getRequestUri();
        $position = strrpos($response['endpoint'], '=');
        $cleanedUrl = substr($response['endpoint'], 0, $position + 1);

        $response['current_page'] = $pageNumber;
        $response['previous_url'] = $pageNumber > 1 ? $cleanedUrl . '' . ($pageNumber - 1) : null;
        $response['next_url'] = $cleanedUrl.''.$pageNumber + 1;

        $this -> concatMovie($response['movies']);

        return view('list-movie', [
            'section' => $response,
        ]);
    }

    private function fetchMovies($url, $limit = 0) {
        $response = Http::withToken($this->tmdb_token)
            ->get($this->movie_url . $url)
            ->json();

        $movies = $response['results'];

        if ($limit != 0) {
            $movies = $this -> sliceMovie($response['results'], $this -> movie_limit);
        }

        return $movies;
    }

    private function generatePageLink($response) {
        $cleanedUrl = substr($response['endpoint'], 0, strpos($response['endpoint'], '='));
        return [$response['current_page'] > 1 ? $cleanedUrl . '=' . ($response['current_page'] - 1) : null, $cleanedUrl.'='.$response['current_page'] + 1];
    }

    private function sliceMovie($movies, $limit) {
        return array_slice($movies, 0, $limit);
    }

    private function list_init($target, $page) {
        $pageNumber = substr($page, strpos($page, '=') + 1);

        $response = $this-> getSection($target, $pageNumber);
        $response['movies'] = $this->fetchMovies($response['url']);
        $response['current_page'] = $pageNumber;

        $pagination_link = $this -> generatePageLink($response);
        $response['previous_url'] = $pagination_link[0];
        $response['next_url'] = $pagination_link[1];

        $this -> concatMovie($response['movies']);

        return $response;
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