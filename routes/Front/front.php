<?php

use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/','HomeController@index')->name('frontend.index');

Route::get('donors','HomeController@donors')->name('frontend.donors');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{locale}','LocalizationController@lang')->name('lang');
Route::get('donors/search','HomeController@search')->name('donors.search');

