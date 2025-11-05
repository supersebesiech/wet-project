<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/passwordreset', function () {
    return view('auth.passwordreset');
})->name('passwordreset');

Route::get('/foryou', [PostController::class, 'foryou']
)->name('foryou');

Route::get('/profile',[PostController::class, 'profile']
)->name('profile');

Route::get('/test', [PostController::class, 'index'])->name('posts.index');
// returns the form for adding a post
Route::get('/test/posts/create', [PostController::class, 'create'])->name('posts.create');
// adds a post to the database
Route::post('/test/posts', [PostController::class, 'store'])->name('posts.store');
// returns a page that shows a full post
Route::get('/test/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// returns the form for editing a post
Route::get('/test/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
// updates a post
Route::put('/test/posts/{post}', [PostController::class, 'update'])->name('posts.update');
// deletes a post
Route::delete('/test/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
