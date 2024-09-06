<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/myaccount', function() {
    return view ('myaccount');
});

Route::get('/about', function() {
    return view ('about');
});

