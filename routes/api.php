<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('userApi', UserController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('category', CategoryController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});
