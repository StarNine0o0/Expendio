<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VistasController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [VistasController::class, 'returnVistaLogin']);
    
Route::get('/menu', [VistasController::class, 'returnVistaMenu']);
    
Route::get('/almacen', [VistasController::class, 'returnVistaAlmacen']);
   

