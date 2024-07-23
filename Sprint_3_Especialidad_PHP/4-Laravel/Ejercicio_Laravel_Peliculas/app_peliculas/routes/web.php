<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PeliculaController;

// Route::get('/', function () {
//     return view('index');
// });

//Route::get('/','ControllerRoutes@index');

Route::get('/', [PeliculaController::class, 'index'])
    ->name('index');

Route::get('/peliculas/{id}', [PeliculaController::class, 'show'])
    ->name('show');

Route::get('/crear_pelicula', [PeliculaController::class, 'mostrarFormulario'])
    ->name('formulario.show');

Route::post('/crear_pelicula/enviar', [PeliculaController::class, 'crear'])
    ->name('formulario.enviar');

// Route::resource('/', [PeliculaController::class, 'borrar']);
Route::delete('/eliminar/{id}', [PeliculaController::class, 'eliminiar'])
    ->name('eliminar');

Route::get('/pre_modificar/{id}', [PeliculaController::class, 'pre_modificar'])
    ->name('pre_modificar'); 
    
Route::post('/modificar/{id}', [PeliculaController::class, 'modificar'])
    ->name('modificar'); 