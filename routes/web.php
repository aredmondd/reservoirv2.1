<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;

Route::get('/', function () {
    return view('index');
});

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

Route::get('/movie-demo',[TMDBController::class, 'mainMovieFunc'])->name('movie-api-demo');

Route::get('/movie-description', function () {
    return view('movie-description');
})->name('movie-description');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
