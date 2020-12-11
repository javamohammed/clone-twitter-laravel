<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ControllerSubscribe;
use App\Http\Controllers\HashtagController;
use App\Http\Controllers\ListController;

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

Route::get('/zz/zz', [TweetController::class, 'zz'] )->name('zzzz');

Route::get('/like/{tweet_id}', [LikeController::class, 'store'] )->name('save.like');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/home', [TweetController::class, 'index'] )->name('home');
    Route::get('/profile', [TweetController::class, 'profile'] )->name('profile');
    Route::get('/{userId}', [TweetController::class, 'getUser'] )->name('get_user');
    Route::get('/comments/{tweet_id}/{back}', [CommentController::class, 'index'] )->name('show_comments');
    Route::post('/tweet', [TweetController::class, 'store'] )->name('save.tweet');
    Route::get('/retweet/{id}', [TweetController::class, 'retweet'] )->name('retweet.tweet');
    Route::post('/comment/{tweet_id}/{redirect_to}', [CommentController::class, 'store'] )->name('save.comment');

    //Bookmark
    Route::get('/bookmark/all', [BookmarkController::class, 'index'] )->name('bookmark.index');
    Route::get('/bookmark/save/{tweet_id}', [BookmarkController::class, 'store'] )->name('bookmark.save');
    Route::delete('/bookmark/delete', [BookmarkController::class, 'destroy'] )->name('bookmark.delete');    
    
    //Subscribe
    Route::get('/subscribe/{user_id}/{id_follow}', [ControllerSubscribe::class, 'subscribe'] )->name('subscribe.save');
    Route::get('/subscribe/suggestions', [ControllerSubscribe::class, 'index'] )->name('subscribe.index');
    
    //Hashtag
    Route::get('/hashtag/{hashtag}', [HashtagController::class, 'index'] )->name('hashtag.index');

    //lists
    Route::get('/lists/all', [ListController::class, 'index'] )->name('lists.index');
    Route::get('/lists/on', [ListController::class, 'listsOn'] )->name('lists.on');
    Route::post('/lists/save', [ListController::class, 'store'] )->name('lists.save');

    Route::get('/back/{page}', function($page){
        if($page == 'profile'){
            return redirect('/profile');
        }
        return redirect('/home');
        
    })->name('back');
    
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