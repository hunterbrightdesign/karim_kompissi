<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\QuizController;
use App\Http\Controllers\Api\v1\QuizQuestionController;
use App\Http\Controllers\Api\v1\QuestionResponcesController;
use App\Http\Controllers\Api\v1\UserQuizResponceController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('/quiz', QuizController::class)->except(['create', 'edit'])->middleware('auth:sanctum');
Route::apiResource('/quiz-question', QuizQuestionController::class)->except(['create', 'edit'])->middleware('auth:sanctum');
Route::apiResource('/question-responces', QuestionResponcesController::class)->except(['create', 'edit'])->middleware('auth:sanctum');
Route::apiResource('/user-quiz-responce', UserQuizResponceController::class)->except(['create', 'edit'])->middleware('auth:sanctum');
Route::post('/user-quiz/responce', [UserQuizResponceController::class,'UserQuizResponc'])->middleware('auth:sanctum');

