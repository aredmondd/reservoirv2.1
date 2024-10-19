<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Models\Stack;


// Basic Routes

Route::get('/',[TMDBController::class, 'mainMovieFunc'])->name('index'); // home page
Route::get('/movie-description/{movie}/{flag}',[TMDBController::class, 'movieDetails'])->name('movie-description');
Route::get('/about', function () { return view('about'); })->name('about'); //about page


// Auth Routes

Route::middleware('auth')->group(function () {
    Route::get('/discover', function () { return view('ripple'); })->name('discover');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    Route::get('/stack', [StackController::class, 'testGetStack'])->name('stack-view');

    // user stuff
    Route::get('/user/{username}', [UserController::class, 'display'])->name('user-profile');
    Route::get('/user/{username}/watchlist', [UserController::class, 'display'])->name('user-watchlist');
    Route::get('/user/{username}/history', [UserController::class, 'display'])->name('user-history');
    Route::get('/user/{username}/stacks', [UserController::class, 'display'])->name('user-stacks');
    Route::get('/user/{username}/journal', [UserController::class, 'display'])->name('user-diary');

    // dashboard stuff
    Route::get('/dashboard', [DashboardController::class, 'display'])->name('dashboard');

    // profile stuff
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/update-visibility', [UserController::class, 'updateVisibility'])->name('profile.update-visibility');

    // add to a list (watchlist or history)
    Route::post('/watchlist', [ContentController::class, 'addTowatchlist'])->name('watchlist.add');
    Route::post('/history', [ContentController::class, 'addToHistory'])->name('history.add');

    // friends stuff
    Route::get('/search', [UserController::class, 'search'])->name('search');

    // profile picture stuff
    Route::get('/profile/picture/edit', [ProfileController::class, 'editProfilePicture'])->name('profile.picture.edit');
    Route::post('/profile/picture/update', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::delete('/profile/picture/delete', [ProfileController::class, 'deleteProfilePicture'])->name('profile.picture.delete');

    // Stacks
    Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');
    Route::get('/search/results', [TMDBController::class, 'search'])->name('search-results');
    Route::post('/new-stack-movie', [StackController::class, 'movie'])->name('add-movie-stack');
    Route::delete('/stack', [StackController::class, 'destroy']);

    Route::post('/add-content', [DashboardController::class, 'add'])->name('add-content');
    Route::post('/favorite', [DashboardController::class, 'fav'])->name('favorite');
    Route::post('/move-content', [DashboardController::class, 'move'])->name('move-content');
    Route::delete('/delete-content', [DashboardController::class, 'delete'])->name('delete-content');
});

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';