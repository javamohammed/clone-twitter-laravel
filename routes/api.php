<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\JwtAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [JwtAuthController::class, 'login'] )->name("login.jwt");


Route::group(['middleware' => 'jwt.auth' ], function () {
    Route::get('/test', [ApisController::class, 'test'] )->name('test');
    Route::get('/users', [ApisController::class, 'users'] )->name('users');
    Route::get('/users/{user}', [ApisController::class, 'user'] )->name('user');
    Route::post('/users/self', [ApisController::class, 'getSelfInfos'] )->name('self.info');

});


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/