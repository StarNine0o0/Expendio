<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/test', function(Request $request) {
    return response()->json([
        'message'=> 'successful request',
        'mensaje'=> 'success',
        'time'=> now(),
        'server_time'=> date('Y-m-d H:i:s'),

    ] );
});

Route::get('/users',[UserController::class, 'index']); //obtener usuarios
Route::post('/users',[UserController::class, 'store']); //crear usuario

Route::post('/register', [UserController::class, 'store']);