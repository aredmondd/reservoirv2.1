<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\StackController;
use App\Models\Stack;


// Get Routes
Route::get('/',[TMDBController::class, 'mainMovieFunc'])->middleware('guest')->name('index');
Route::get('/movie-description/{movie}',[TMDBController::class, 'description'])->name('movie-description');
Route::get('/movie-demo',[TMDBController::class, 'mainMovieFunc'])->name('movie-api-demo');
Route::get('/about', function () { return view('about'); })->name('about');


// Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/my-reservoir', function () { return view('my-reservoir'); })->name('my-reservoir');
    Route::get('/discover', function () { return view('ripple'); })->name('discover');
    Route::get('/stacks', [StackController::class, 'display'])->name('my-stacks');
    Route::get('/stack', [StackController::class, 'getStack'])->name('stack-view');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // profile stuff
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Make new stacks
Route::post('/new-stack', [StackController::class, 'store'])->name('new-stack');

// Delete a stack
Route::delete('/stack', [StackController::class, 'destroy']);

// Catch all route
Route::fallback(function () { abort(404); });

require __DIR__.'/auth.php';