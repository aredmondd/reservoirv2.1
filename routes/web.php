<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    return view('welcome');
});

Route::get('/register', function (Request $request) {
    return view('register');
});

Route::get('/signin', function (Request $request) {
    return view('signin');
});

Route::get('/myaccount', function(Request $request) {
    return view ('myaccount');
});

Route::get('/about', function(Request $request) {
    return view ('about');
});

