<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ShoeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\RatingController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/shoes', [ShoeController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::delete('/bills/{id}', [BillController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/bill', [BillController::class, 'store']);
    Route::get('/bill/user', [BillController::class, 'index']);
    Route::post('/bill', [BillController::class, 'store']);
    Route::post('/ratings', [RatingController::class, 'store']);
});