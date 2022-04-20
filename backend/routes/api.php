<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowingController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AnswersController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('test', [AuthController::class, 'test_api']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::post('update-profile', [ProfileController::class, 'update_profile']);

    Route::post('follow', [FollowingController::class, 'follow_user']);
    Route::post('follow-back', [FollowingController::class, 'follow_back']);
    Route::get('user-list', [FollowingController::class, 'user_list']);
    Route::get('user-relationships', [FollowingController::class, 'get_user_relationship']);
    Route::post('unfollow', [FollowingController::class, 'unfollow']);

    Route::post('create-category', [CategoriesController::class, 'create_category']);
    Route::post('edit-category', [CategoriesController::class, 'edit_category']);
    Route::post('delete-category', [CategoriesController::class, 'delete_category']);
    Route::get('get-category', [CategoriesController::class, 'get_category']);
    Route::get('get-category-with-questions', [CategoriesController::class, 'get_category_with_questions']);

    Route::post('create-questions', [QuestionsController::class, 'create_question']);
    Route::get('get-questions', [QuestionsController::class, 'get_questions']);
    Route::post('edit-question', [QuestionsController::class, 'edit_question']);
    Route::post('delete-question', [QuestionsController::class, 'delete_question']);

    Route::post('create-answer', [AnswersController::class, 'create_answer']);
});
