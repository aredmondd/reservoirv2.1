<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TMDBController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/myaccount', function() {
    return view ('myaccount');
});

Route::get('/about', function() {
    return view ('about');
});

# route for tmdb controller
Route::get('/movies',[TMDBController::class, 'mainMovieFunc'])->name('movies');

