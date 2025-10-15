<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/calculadora', function () {
    return view('calculadora');
});

Route::get('/tibio', function () {
    return 'Tibio';
});
