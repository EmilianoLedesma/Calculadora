<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;
use App\Http\Controllers\DivisionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculadora', function () {
    return view('calculadora');
});

Route::post('/dividir', [DivisionController::class, 'dividir'])->name('dividir');
