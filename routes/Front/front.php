<?php

Route::get('/',function (){
    return view('welcome');
});

Route::get('/','HomeController@index');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/lang/{locale}','LocalizationController@lang')->name('lang');

