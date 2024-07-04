<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index'])->name('home');

Route::get('/movie/toprated/{page}', [MovieController::class, 'toprated']) -> name('toprated');
Route::get('/movie/popular/{page}', [MovieController::class, 'popular']) -> name('popular');
Route::get('/movie/trending/{page}', [MovieController::class, 'trending']) -> name('trending');
Route::get('/movie/{movie}', [MovieController::class, 'showMovie']) -> name('movie.show');

Route::get('/search', [MovieController::class, 'search']) -> name('search');