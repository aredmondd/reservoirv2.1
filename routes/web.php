<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Route;
use App\Models\Stack;


Route::get('/',[TMDBController::class, 'mainMovieFunc'])->name('index'); 
Route::get('/movie-description/{movie}/{flag}',[TMDBController::class, 'movieDetails'])->name('movie-description');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/movie-api-demo',[MusicController::class, 'main'])->name('main');


// Routes only for authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'display_list'])->name('dashboard');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    Route::get('/stack', [StackController::class, 'getStackContent'])->name('stack-view');
    Route::get('/discover', function () { return view('ripple'); })->name('discover');

    // stacks
    Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');
    Route::get('/search/results', [TMDBController::class, 'search'])->name('search-results');
    Route::delete('/stack', [StackController::class, 'destroy']);
    Route::delete('/stack-content', [StackController::class, 'destoryContent']);
    Route::post('/favorite', [DashboardController::class, 'fav_content'])->name('favorite');
    Route::post('/move-content', [DashboardController::class, 'move'])->name('move-content');
    Route::delete('/delete-content', [DashboardController::class, 'delete_content_from_list'])->name('delete-content');

    // user search
    Route::get('/friends', [UserController::class, 'search'])->name('search');
    Route::get('/user/{username}', [UserController::class, 'display'])->name('user-profile');
    Route::get('/user/{username}/watchlist', [UserController::class, 'display'])->name('user-watchlist');
    Route::get('/user/{username}/history', [UserController::class, 'display'])->name('user-history');
    Route::get('/user/{username}/stacks', [UserController::class, 'display'])->name('user-stacks');
    Route::get('/user/{username}/journal', [UserController::class, 'display'])->name('user-diary');

    // edit your profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/update-visibility', [UserController::class, 'updateVisibility'])->name('profile.update-visibility');

    // profile pictures
    Route::get('/profile/picture/edit', [ProfileController::class, 'editProfilePicture'])->name('profile.picture.edit');
    Route::post('/profile/picture/update', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::delete('/profile/picture/delete', [ProfileController::class, 'deleteProfilePicture'])->name('profile.picture.delete');

    // add content to a list watchlist/history/stack
    Route::post('/watchlist', [ContentController::class, 'add_to_watchlist'])->name('watchlist.add');
    Route::post('/history', [ContentController::class, 'add_to_history'])->name('history.add');
    Route::post('/addToStack', [ContentController::class, 'add_to_stack'])->name('stack.add');
});

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';

// EOF