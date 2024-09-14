<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TMDBController;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('welcome');
});

// added controller to control the sign in and out capabilities
Route::get('/register', [SessionController::class, 'registerView'])->middleware('guest');
Route::post('/register', [SessionController::class, 'store'])->middleware('guest');

// Route::get('/register', function () {
//     return view('register');
// });

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

# search
Route::get('/search',[TMDBController::class, 'search'])->name('search');

