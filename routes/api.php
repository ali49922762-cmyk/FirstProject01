<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CategoryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hotels',[HotelController::class,'index']);

Route::get('/hotels/{id}', [HotelController::class, 'show']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('hotels', [HotelController::class, 'store']);
});

Route::post('/hotels/{id}', [HotelController::class, 'update']);

Route::delete('/hotel/{id}', [HotelController::class, 'delete']);

///////////////////////////////////////////////////////////////////////////

Route::get('/categories',[CategoryController::class,'index']);

Route::get('/categories/{id}', [CategoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('add', [CategoryController::class, 'store']);
});

Route::post('/categories/{id}', [CategoryController::class, 'update']);

Route::delete('/categories/{id}', [CategoryController::class, 'delete']);

