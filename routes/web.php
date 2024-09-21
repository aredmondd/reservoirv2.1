<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('new-welcome');
});

// added controller to control the sign in and out capabilities
Route::get('/register', [SessionController::class, 'registerView'])->middleware('guest');
Route::post('/register', [SessionController::class, 'store'])->middleware('guest');

// Route::get('/register', function () {
//     return view('register');
// });

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/myaccount', function() {
    return view ('myaccount');
});

Route::get('/about', function() {
    return view ('about');
});

