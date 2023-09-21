<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register/user', [UserController::class, 'createUser']);
Route::post('auth/login', [AuthController::class, 'login'])->middleware('throttle:10,1');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);

Route::group(['middleware' => ['auth.api']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getMe']);

    Route::post('/image/upload', [ImageController::class, 'uploadImage']);

    Route::post('/post/create', [PostController::class, 'createPost']);
    Route::get('/posts', [PostController::class, 'getAllPosts']);
    Route::get('/post/{id}', [PostController::class, 'getPostById']);

});
