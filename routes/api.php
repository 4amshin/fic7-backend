<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UploadController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('userApi', UserController::class);
    Route::apiResource('productApi', ProductController::class);
    Route::apiResource('category', CategoryController::class);

    Route::post('upload/image', [UploadController::class, 'uploadImage']);
    Route::post('upload/multiple-image', [UploadController::class, 'uploadMultipleImage']);

    Route::post('orders', [OrderController::class, 'order']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route untuk menerima callback pembayaran dari Midtrans
Route::post('midtrans/notification/handling', [CallbackController::class, 'receive']);
