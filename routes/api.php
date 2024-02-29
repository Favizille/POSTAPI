<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Profile Routes
Route::post('/profile/create', [UserController::class, 'createProfile']);
Route::get('/profile/{profileId}', [UserController::class, 'getProfile']);
Route::put('/profile/update/{profileId}', [UserController::class, 'updateProfile']);
Route::delete('/profile/delete/{profileId}', [UserController::class, 'deleteProfile']);
