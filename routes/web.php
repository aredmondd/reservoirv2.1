<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Models\Stack;


// Get Routes
Route::get('/',[TMDBController::class, 'mainMovieFunc'])->middleware('guest')->name('index');
Route::get('/movie-description/{movie}',[TMDBController::class, 'movieDetails'])->name('movie-description');
Route::get('/movie-demo',[TMDBController::class, 'mainMovieFunc'])->name('movie-api-demo');
Route::get('/about', function () { return view('about'); })->name('about');


// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-reservoir', function () { return view('my-reservoir'); })->name('my-reservoir');
    Route::get('/discover', function () { return view('ripple'); })->name('discover');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    // was commented out getStack
    Route::get('/stack', [StackController::class, 'testGetStack'])->name('stack-view');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // profile stuff
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Make new stacks
Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');

// Make new stacks for movies
Route::get('/search/results', [TMDBController::class, 'search'])->name('search-results');
Route::post('/new-stack-movie', [StackController::class, 'movie'])->name('add-movie-stack');

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';