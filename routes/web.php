<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/like/{tweet_id}', [LikeController::class, 'store'] )->name('save.like');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', [TweetController::class, 'index'] )->name('home');
    Route::get('/profile', [TweetController::class, 'profile'] )->name('profile');
    Route::get('/comments/{tweet_id}', [CommentController::class, 'index'] )->name('show_comments');
    Route::post('/tweet', [TweetController::class, 'store'] )->name('save.tweet');
    Route::post('/comment/{tweet_id}/{redirect_to}', [CommentController::class, 'store'] )->name('save.comment');
    
});

/*
Route::get('/home', [TweetController::class, 'index'] )->middleware(['auth:sanctum', 'verified'])->name('home');
Route::post('/tweet', [TweetController::class, 'store'] )->middleware(['auth'])->name('save.tweet');
Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function () {
    return view('profile');
})->name('profile');
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');






Route::get('/email/verify',  [AuthController::class, 'getVerifyEmail'])
        ->middleware(['auth'])
        ->name('verification.notice');

Route::post('/email/verification-notification', [AuthController::class, 'verificationNotification'] )
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'postVerifyEmail'] )
        ->middleware(['auth', 'signed'])
        ->name('verification.verify');