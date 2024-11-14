<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostImageController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/get', [App\Http\Controllers\GetController::class, 'index']);
    Route::get('/users/{id}/posts', [UserController::class, 'posts']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::get('/users', [UserController::class, 'index']);
    Route::resource('posts', PostController::class);
    Route::post('/post_image', [PostImageController::class, 'store']);
});
