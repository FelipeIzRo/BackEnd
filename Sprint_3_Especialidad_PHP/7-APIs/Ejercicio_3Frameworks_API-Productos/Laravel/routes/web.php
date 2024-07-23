<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductosController;

// Route::get('/', function () {
//     return view('index');
// });

//Route::get('/','ControllerRoutes@index');

Route::get('/', [ProductosController::class, 'index'])
    ->name('index');

Route::get('/{id}',[ProductosController::class,'showOne'])
    ->name('show_one');

Route::post('/', [ProductosController::class, 'store'])
    ->name('store');

Route::delete('/delete/{id}', [ProductosController::class, 'delete'])
    ->name('delete');

Route::put('/modify/{id}/{field}/{value}', [ProductosController::class, 'modify'])
    ->name('modify');

Route::put('/modify_json/{id}', [ProductosController::class, 'modify_json'])
    ->name('modify_json');    
