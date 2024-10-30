<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Models\Stack;
use App\Http\Controllers\FastAPIController;


Route::get('/',[TMDBController::class, 'mainMovieFunc'])->middleware('guest')->name('index');

Route::get('/movie-description/{movie}',[TMDBController::class, 'description'])->name('movie-description');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/my-reservoir', function () {
    return view('my-reservoir');
})->middleware('auth')->name('my-reservoir');

Route::get('/discover', function () {
    return view('ripple');
})->middleware('auth')->name('discover');

Route::get('/stacks', function () {
    return view('stacks');
})->middleware('auth')->name('stacks');

Route::get('/stack', function () {
    return view('stack-view');
})->name('stack-view');

Route::get('/movie-demo',[TMDBController::class, 'mainMovieFunc'])->name('movie-api-demo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/stack-test', [StackController::class, 'display'])->name('stack-test');
Route::get('/new-stack', function () {
    abort(404);
});
Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');

#ai routes
Route::get('/fastapi-data', [FastAPIController::class, 'getDataFromFastAPI']);
Route::post('/fastapi-data', [FastAPIController::class, 'createUserInFastAPI']);
Route::get('/user', [App\Http\Controllers\FastAPIController::class, 'showUser']);




require __DIR__.'/auth.php';
