<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\LikesController;
use App\Http\Controllers\Api\v1\VideoController;

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

Route::apiResource('/post', PostController::class);
Route::apiResource('/video', VideoController::class);
Route::apiResource('/likes', LikesController::class);
Route::post('/likes/video', [LikesController::class,'likeVideo']);
