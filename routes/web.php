<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TMDBController;


Route::get('/',[TMDBController::class, 'mainMovieFunc'])->name('index');
// Route::get('/', function () {
//     return view('index');
// });



Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/movie-description/{movie}',[TMDBController::class, 'description'])->name('movie-description');



// Route::get('/movie-description', function () {
//     return view('movie-description');
// })->name('movie-description');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
