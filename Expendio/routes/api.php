<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;//Rutas API
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventarioController;

// Test route
Route::get('/test', function () {
    return response()->json([
        'message'=> 'successful request',
        'server_time'=> now(),
    ]);
});

// Auth routes (públicas)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// CRUD USERS (solo con token)
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function () {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/users',[UserController::class, 'index']); 
    Route::post('/users',[UserController::class, 'store']); 

    Route::apiResource('productos', InventarioController::class);
});
