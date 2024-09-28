<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;
use App\Models\Stack;


Route::get('/',[TMDBController::class, 'mainMovieFunc'])->name('index');

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

Route::get('/stack-test', function () {
    dd(Stack::all()[0]->user->name);
});



require __DIR__.'/auth.php';
