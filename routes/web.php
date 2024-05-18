<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register_itens', [App\Http\Controllers\RegistarItensController::class, 'index'])->name('register_itens');

Route::post('/register_itens', [App\Http\Controllers\RegistarItensController::class, 'create'])->name('registarItens');

