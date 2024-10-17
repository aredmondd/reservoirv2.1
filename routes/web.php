<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Stack;


// Get Routes
Route::get('/',[TMDBController::class, 'mainMovieFunc'])->name('index');
Route::get('/movie-description/{movie}/{flag}',[TMDBController::class, 'movieDetails'])->name('movie-description');
Route::get('/movie-demo',[TMDBController::class, 'mainMovieFunc'])->name('movie-api-demo');
Route::get('/about', function () { return view('about'); })->name('about');

Route::get('/search', [UserController::class, 'search'])->name('search');


// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/discover', function () { return view('ripple'); })->name('discover');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    // was commented out getStack
    Route::get('/stack', [StackController::class, 'testGetStack'])->name('stack-view');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/user/{username}', [UserController::class, 'display'])->name('display');

    // profile stuff
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/update-visibility', [UserController::class, 'updateVisibility'])->name('profile.update-visibility');
});

// Profile picture stuff
Route::middleware('auth')->group(function () {
    Route::get('/profile/picture/edit', [ProfileController::class, 'editProfilePicture'])->name('profile.picture.edit');
    Route::post('/profile/picture/update', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::delete('/profile/picture/delete', [ProfileController::class, 'deleteProfilePicture'])->name('profile.picture.delete'); // Delete route
});

// Make new stacks
Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');

// Make new stacks for movies
Route::get('/search/results', [TMDBController::class, 'search'])->name('search-results');
Route::post('/new-stack-movie', [StackController::class, 'movie'])->name('add-movie-stack');

// Delete a stack
Route::delete('/stack', [StackController::class, 'destroy']);

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';