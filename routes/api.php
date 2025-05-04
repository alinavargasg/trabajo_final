<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rutas para productos
Route::get('/libros', [LibroController::class, 'index']);
Route::post('/libros', [LibroController::class, 'store']);
Route::get('/libros/{id}', [LibroController::class, 'show']);
Route::put('/libros/{id}', [LibroController::class, 'update']);
Route::delete('/libros/{id}', [LibroController::class, 'destroy']);

// Rutas para Pedidos
Route::get('/prestamos', [App\Http\Controllers\PrestamoController::class, 'index']);
Route::post('/prestamos', [\App\Http\Controllers\PrestamoController::class, 'store']);
Route::get('/prestamos/{id}', [\App\Http\Controllers\PrestamoController::class, 'show']);
Route::put('/prestamos/{id}', [\App\Http\Controllers\PrestamoController::class, 'update']);
Route::delete('/prestamos/{id}', [\App\Http\Controllers\PrestamoController::class, 'destroy']);
// Rutas para Autores
Route::get('/autores', [\App\Http\Controllers\AutorController::class, 'index']);
Route::post('/autores', [\App\Http\Controllers\AutorController::class, 'store']);
Route::get('/autores/{id}', [\App\Http\Controllers\AutorController::class, 'show']);
Route::put('/autores/{id}', [\App\Http\Controllers\AutorController::class, 'update']);
Route::delete('/autores/{id}', [\App\Http\Controllers\AutorController::class, 'destroy']);