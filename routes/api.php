<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IceBathController;
use App\Http\Controllers\SleepTrackingController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth Controller Routes
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);

    // UserData Controller Routes
    Route::get('/user/data', [UserDataController::class, 'show']);
    Route::post('/user/data', [UserDataController::class, 'update']);

    // IceBath Controller Routes
    Route::post('/icebaths', [IceBathController::class, 'store']);
    Route::get('/icebaths', [IceBathController::class, 'index']);
    Route::put('/icebaths/{id}', [IceBathController::class, 'update']);
    Route::delete('/icebaths/{id}', [IceBathController::class, 'destroy']);

    // SleepTracking Controller Routes
    Route::post('/sleep-tracking', [SleepTrackingController::class, 'store']);
    Route::get('/sleep-tracking', [SleepTrackingController::class, 'index']);
    Route::put('/sleep-tracking/{id}', [SleepTrackingController::class, 'update']);
    Route::delete('/sleep-tracking/{id}', [SleepTrackingController::class, 'destroy']);
});

