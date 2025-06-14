<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ShoeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BillController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\CommentController;

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/shoes', [ShoeController::class, 'index']);
Route::get('/shoes/{id}', [ShoeController::class, 'show']);
Route::get('/shoes/{id}/comments', [CommentController::class, 'show']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::delete('/bills/{id}', [BillController::class, 'destroy']);
Route::get('/bills/{id}', [BillController::class, 'show']);
Route::post('/bills/{id}/pay', [BillController::class, 'pay']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/bills', [BillController::class, 'store']);
    Route::get('/user/bills', [BillController::class, 'index']);
    Route::post('/ratings', [RatingController::class, 'store']);
    Route::post('/shoes/{id}/comments', [CommentController::class, 'store']);
});