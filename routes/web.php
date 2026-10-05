<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');

Route::view('/tecnologia', 'tecnologia')->name('tecnologia');
Route::view('/inflables', 'inflables')->name('inflables');
Route::view('/contabilidad', 'contabilidad')->name('contabilidad');
Route::view('/marketing', 'marketing')->name('marketing');
Route::view('/store', 'store')->name('store');