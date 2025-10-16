<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculadoraController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculadora', function () {
    return view('calculadora');
});

Route::get('/tibio', function () {
    return 'Tibio';
});

Route::post('/multiplicar', [CalculadoraController::class, 'multiplicar'])->name('multiplicar');
Route::post('/dividir', [CalculadoraController::class, 'dividir'])->name('dividir');
Route::post('/raiz', [CalculadoraController::class, 'raiz'])->name('raiz');
Route::post('/sumar', [CalculadoraController::class, 'sumar'])->name('sumar');
Route::post('/potencia', [CalculadoraController::class, 'potencia'])->name('potencia');
Route::post('/restar', [CalculadoraController::class, 'restar'])->name('restar');
