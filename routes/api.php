<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PlantController;
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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'currentUser']);

    Route::put('/user/{user}', [UserController::class, 'update']);

    Route::prefix('/plants')->group(function () {
        Route::get('', [PlantController::class, 'index']);
        Route::post('/search', [PlantController::class, 'search']);
        Route::get('/{plant}', [PlantController::class, 'getPlantById']);
        Route::post('/store', [PlantController::class, 'store']);
        Route::delete('/{plant}', [PlantController::class, 'deletePlant']);
        Route::put('/{plant}/guardian/store', [PlantController::class, 'storeGuardian']);
    });

    Route::prefix('/comments')->group(function () {
       Route::post('/plants/{plant}/store', [CommentsController::class, 'store']);
    });
});

