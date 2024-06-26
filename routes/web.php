<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/criar', [App\Http\Controllers\CriarController::class, 'index'])->name('criar');

Route::post('/criar', [App\Http\Controllers\CriarController::class, 'criar'])->name('criar');

Route::get('/actualizar', [App\Http\Controllers\ActualizarController::class, 'index'])->name('actualizar');

Route::post('/actualizar', [App\Http\Controllers\ActualizarController::class, 'actualizar'])->name('actualizar');
