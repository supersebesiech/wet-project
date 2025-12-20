<?php

use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendshipController;
use Illuminate\Support\Facades\Schedule;


Route::get('/', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store'])->middleware('throttle:5,1');
Route::post('/sendTwoFA', [SessionController::class, 'send'])->middleware('throttle:2,1');
Route::get('authentification', [SessionController::class, 'authentificationView'])->middleware('throttle:5,1');
Route::post('/logout', [SessionController::class, 'destroy'])->middleware(['auth', 'verified']);
Route::get(uri: '/logout', action: [SessionController::class, 'destroy'])->name(name: 'logout')->middleware(['auth', 'verified']);

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify-email/{id}/{hash}', [VerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
Route::get('/verify-email-change/{id}/{email}', [VerificationController::class, 'verifyNewEmail'])->middleware(['signed', 'auth'])->name('verification.verify.new-email');

Route::get('/reset-request', [PasswordResetController::class, 'resetRequest']);
Route::post('/send', [PasswordResetController::class, 'send']);
Route::get('/resetPassword', [PasswordResetController::class, 'reset']);
Route::post('/reset', [PasswordResetController::class, 'resetPassword']);

//search bar
Route::get('/search-users', [RegisteredUserController::class, 'search'])->name('search.users')->middleware(['auth', 'verified']);

Route::get('/for-you', [PostController::class, 'foryou']
)->name('user.for-you')->middleware(['auth', 'verified']);

Route::get('/profile',[ProfileController::class, 'profile']
)->name('user.profile')->middleware(['auth', 'verified']);
Route::post('/edit',[ProfileController::class, 'editUser'])->middleware(['auth', 'verified']);
Route::post('/upload',[ProfileController::class, 'upload'])->middleware(['auth', 'verified']);

// searched users profile page
Route::get('/users/{id}', [RegisteredUserController::class, 'show'])->name('users.show')->middleware(['auth', 'verified']);

Route::delete('/users/{user}', [RegisteredUserController::class, 'destroy'])->name('users.destroy')->middleware(['auth', 'verified']);

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware(['auth', 'verified']);
// adds a post to the database
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware(['auth', 'verified']);
// returns a page that shows a full post
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth', 'verified']);
// returns the form for editing a post
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(['auth', 'verified']);
// updates a post
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware(['auth', 'verified']);
// deletes a post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(['auth', 'verified']);
//msgs
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/messages', [MessageController::class, 'fetchMessages']);
    Route::post('/messages/send', [MessageController::class, 'sendMessage']);
    Route::get('/api/chat/history', [MessageController::class, 'getChatHistory']);
    Route::get('/api/friends/list', [MessageController::class, 'getFriends']);
    Route::get('/api/chat/unread-summary', [MessageController::class, 'getUnreadSummary']);
});

//friendship routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/friend/send/{id}', [FriendshipController::class, 'send'])->name('friend.send');
    Route::post('/friend/accept/{id}', [FriendshipController::class, 'accept'])->name('friend.accept');
    Route::post('/friend/deny/{id}', [FriendshipController::class, 'deny'])->name('friend.deny');
    Route::delete('/friend/remove/{id}', [FriendshipController::class, 'remove'])->name('friend.remove');
});

Schedule::command('users:delete-unverified-accounts')->hourly();
