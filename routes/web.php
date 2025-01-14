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
Route::get('/content/{movie}/{flag}',[TMDBController::class, 'movieDetails'])->name('content');
Route::get('/about', function () { return view('about'); })->name('about');

// Routes only for authenticated users
Route::middleware('auth')->group(function () {

    Route::get('/my-profile', [UserController::class, 'show_my_profile'])->name('my-profile');
    Route::get('/dashboard', [DashboardController::class, 'display_list'])->name('dashboard');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    Route::get('/stack', [StackController::class, 'getStackContent'])->name('stack-view');
    Route::get('/discover', function () { return view('ripple'); })->name('discover');
    Route::get('/my-friends', [UserController::class, 'displayFriends'])->name('my-friends');

    // stacks
    Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');
    Route::get('/search/results', [TMDBController::class, 'search'])->name('search-results');
    Route::delete('/stack', [StackController::class, 'destroy']);
    Route::delete('/stack-content', [StackController::class, 'destoryContent']);
    Route::post('/favorite', [DashboardController::class, 'fav_content'])->name('favorite');
    Route::post('/move-content', [DashboardController::class, 'move_content'])->name('move-content');
    Route::delete('/delete-content', [DashboardController::class, 'delete_content_from_list'])->name('delete-content');
    Route::get('/dashboard/filter', [DashboardController::class, 'filter_list'])->name('display_list');

    // user search
    Route::get('/user/{username}', [UserController::class, 'display'])->name('user-profile');
    Route::get('/user/{username}/watchlist', [UserController::class, 'display'])->name('user-watchlist');
    Route::get('/user/{username}/history', [UserController::class, 'display'])->name('user-history');
    Route::get('/user/{username}/stacks', [UserController::class, 'display'])->name('user-stacks');
    
    Route::post('/search/sendFriendRequest', [UserController::class, 'sendFriendRequest'])->name('friend.add');
    Route::post('/search/acceptFriendRequest', [UserController::class, 'acceptFriendRequest'])->name('friend.accept');
    Route::delete('/search/declineFriendRequest', [UserController::class, 'declineFriendRequest'])->name('friend.decline');
    Route::delete('/search/deleteFriend', [UserController::class, 'deleteFriend'])->name('friend.delete');
    
    Route::get('/user/{username}/currently-watching', [UserController::class, 'display'])->name('user-currently-watching');

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
    Route::post('/currently-watching', [ContentController::class, 'add_to_currently_watching'])->name('currently-watching.add');
    Route::post('/addToStack', [ContentController::class, 'add_to_stack'])->name('stack.add');
    Route::post('/profile/addToFavorite', [UserController::class, 'showProfileFavorites'])->name('profile.addFav');
    Route::delete('/profile/deleteFromFavorite', [ProfileController::class, 'deleteContent'])->name('profile.deleteFav');
    Route::get('/recommendToFriend', [UserController::class, 'recommendContent'])->name('recommend.content');
    Route::post('/recommendToFriend', [UserController::class, 'recommendContent'])->name('recommend.content');
    Route::delete('/recc-content/delete', [UserController::class, 'deleteRecommendedContent'])->name('recc-content.delete');
    Route::post('/watchlist/rec/add_delete', [UserController::class, 'watchlistRecAddDelete'])->name('watchlist.add&delete');
    Route::post('/currently/rec/add_delete', [UserController::class, 'currentlyRecAddDelete'])->name('currently.add&delete');


});

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';

// EOF