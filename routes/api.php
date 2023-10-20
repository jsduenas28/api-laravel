<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CarpetaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/auth/register', [UserController::class, 'registerUser']);
Route::post('/auth/login', [UserController::class, 'loginUser']);


// Estas rutas necesitan Token de acceso para ser usadas
Route::middleware(['auth:sanctum'])->group(function () {
    //Logout
    Route::get('/auth/logout', [UserController::class, 'logoutUser']);

    //Validación
    Route::get('/auth/validarToken', 'App\Http\Controllers\Api\AccessTokenController@validarToken');

    //UserController
    Route::get('/user/index', 'App\Http\Controllers\Api\UserController@index');

    // CarpetaController
    Route::get('/carpeta/index', 'App\Http\Controllers\Api\CarpetaController@index');
    Route::get('/carpeta/carpetaNota', 'App\Http\Controllers\Api\CarpetaController@carpetaNota');
    Route::post('/carpeta/store', 'App\Http\Controllers\Api\CarpetaController@store');
    Route::get('/carpeta/edit/{id}', 'App\Http\Controllers\Api\CarpetaController@edit');
    // el update solo funciona si le paso los datos en un JSON
    Route::put('/carpeta/update/{id}', 'App\Http\Controllers\Api\CarpetaController@update');
    Route::delete('/carpeta/delete/{id}', 'App\Http\Controllers\Api\CarpetaController@destroy');

    // NotaController
    Route::get('/nota/index/{id}', 'App\Http\Controllers\Api\NotaController@index');
    Route::post('/nota/store', 'App\Http\Controllers\Api\NotaController@store');

    Route::get('/nota/edit/{id}', 'App\Http\Controllers\Api\NotaController@edit');
    // El update solo funciona si se le pasan los datos dentro de un JSON
    Route::put('/nota/update/{id}', 'App\Http\Controllers\Api\NotaController@update');

    Route::delete('/nota/delete/{id}', 'App\Http\Controllers\Api\NotaController@destroy');

    //Generador de Cuestionarios
    Route::get('/genCuestionario/{id}', 'App\Http\Controllers\Api\GPTController@genCuestionario');
});
