<?php

use App\Http\Controllers\HomeController;

Route::get('/','HomeController@index');

Route::get('donors','HomeController@donors')->name('donors');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{locale}','LocalizationController@lang')->name('lang');
Route::get('donors/search','HomeController@search')->name('donors.search');

