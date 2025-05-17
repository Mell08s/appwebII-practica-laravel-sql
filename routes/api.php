<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//Importar Controladores
use App\Http\Controllers\ParaleloController;
use App\Http\Controllers\EstudianteController;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); */

//Rutas Estudiantes
Route::get('/estudiantes', [EstudianteController::class ,'index']);//Listar todos
Route::post('/estudiantes', [EstudianteController::class ,'store']);//crear
Route::get('/estudiantes/{id})', [EstudianteController::class ,'show']);//ver uno
Route::put('/estudiantes/{id}', [EstudianteController::class ,'update']);//Actualizar
Route::delete('/estudiantes/{id}', [EstudianteController::class ,'destroy']);//Eliminar


//Rutas Paralelos
Route::get('/paralelos', [ParaleloController::class ,'index']);//Listar Todos
Route::post('/paralelos', [ParaleloController::class ,'store']);//Crear
Route::get('/paralelos/{id}', [ParaleloController::class ,'show']);//Ver uno
Route::put('/paralelos/{id}', [ParaleloController::class ,'update']);//Actualizar
Route::delete('/paralelos/{id}', [ParaleloController::class ,'destroy']);//Eliminar
