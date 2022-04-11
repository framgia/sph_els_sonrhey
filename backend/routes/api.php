<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowingController;

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
    Route::get('user-list', [FollowingController::class, 'user_list']);
    Route::get('user-relationships', [FollowingController::class, 'get_user_relationship']);
});
