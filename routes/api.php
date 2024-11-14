<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'get']);
    Route::post('user', [UserController::class, 'update']);
    Route::get('my-cars', [CarController::class, 'myCars']);
    Route::apiResource('cars', CarController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('types', TypeController::class);
});

Route::get('cars', [CarController::class, 'index']);
Route::get('cars/{car}', [CarController::class, 'show']);
