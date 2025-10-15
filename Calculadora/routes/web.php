<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculadora', function () {
    return view('calculadora');
});

Route::post('/multiplicar', [CalculadoraController::class, 'multiplicar'])->name('multiplicar');
Route::get('/tibio', function () {
    return 'Tibio';
});

Route::post('/dividir', [CalculadoraController::class, 'dividir'])->name('dividir');
