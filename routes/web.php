<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;


Route::get('/', [MovieController::class, 'index'])->name('home');

Route::get('/movie/toprated/{page}', [MovieController::class, 'toprated']);
Route::get('/movie/popular/{page}', [MovieController::class, 'popular']);
Route::get('/movie/trending/{page}', [MovieController::class, 'trending']);

Route::get('/movie/{movie}', [MovieController::class, 'showMovie']) ->name('movie.show');