<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IceBathController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\SleepTrackingController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\ConsumptionController;


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

    // Meal routes
    Route::post('/meals', [MealController::class, 'store']);
    Route::get('/meals', [MealController::class, 'index']);
    Route::get('/meals/{meal}', [MealController::class, 'show']);
    Route::delete('/meals/{id}', [MealController::class, 'destroy']);
    Route::put('/meals/{meal}', [MealController::class, 'update']);


    // Ingredient routes
    Route::post('/meals/{meal}/ingredients', [IngredientController::class, 'store']);
    Route::get('/meals/{meal}/ingredients', [IngredientController::class, 'index']);
    Route::delete('/ingredients/{ingredient}', [IngredientController::class, 'destroy']);
    Route::put('/ingredients/{ingredient}', [IngredientController::class, 'update']);

    // Consumption routes
    Route::get('/consumptions', [ConsumptionController::class, 'index']);
    Route::get('/consumptions/{id}', [ConsumptionController::class, 'show']);
    Route::post('/consumptions', [ConsumptionController::class, 'store']);
    Route::put('/consumptions/{id}', [ConsumptionController::class, 'update']);
    Route::delete('/consumptions/{id}', [ConsumptionController::class, 'destroy']);

    //consumption graph routes
    Route::get('/calories', [ConsumptionController::class, 'caloriesLast7Days']);
    Route::get('/macros', [ConsumptionController::class, 'totalMacrosLast7Days']);
});
