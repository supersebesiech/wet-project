<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/passwordreset', function () {
    return view('auth.passwordreset');
})->name('passwordreset');

Route::get('/foryou', function () {
    return view('pages.foryou');
})->name('foryou');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');
