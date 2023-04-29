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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::get('/users/{Id}/role', [App\Http\Controllers\UserController::class, 'getUserRole']);
Route::get('/user/{Id}/plants', [UserController::class, 'getUserPlants']);
Route::get('/plant/{id}', [PlantController::class, 'getPlantById']);
Route::delete('/plant/{id}', [PlantController::class, 'deletePlant']);
Route::put('/user/{id}', [UserController::class, 'update']);

Route::get('/plants', [App\Http\Controllers\PlantController::class, 'index']);
Route::get('/plants/search', [App\Http\Controllers\PlantController::class, 'search']);
Route::post('/users/{userId}/plants', [PlantController::class, 'create'])->middleware('auth:sanctum');

