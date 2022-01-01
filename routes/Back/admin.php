<?php

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('users',UsersController::class);
Route::resource('setting',SettingsController::class);
Route::get('lucky/find/','LuckyDrawController@find')->name('lucky.find');
Route::get('lucky/search','LuckyDrawController@search')->name('lucky.search');
Route::resource('lucky',LuckyDrawController::class);
Route::resource('roles',RoleController::class);
Route::resource('permissions',PermissionController::class);
Route::resource('dashboard',DashboardController::class);
Route::resource('pathans',PathanController::class);
