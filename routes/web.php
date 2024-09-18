<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/movie', function() {
    return view ('movie_description');
});

