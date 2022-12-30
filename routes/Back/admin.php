<?php

use App\Http\Controllers\Back\DonorController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('users',UsersController::class);
Route::resource('setting',SettingsController::class);
Route::resource('roles',RoleController::class);
Route::resource('permissions',PermissionController::class);
Route::resource('dashboard',DashboardController::class);
Route::resource('pathans',PathanController::class);
Route::post("settings/backup",[\App\Http\Controllers\Back\LuckyDrawController::class,'backup'])
    ->name('settings.backup');

//lucky draw
Route::get('lucky_list','LuckyDrawController@LuckyList')->name('luckys.list_download');
Route::get('empty_list','LuckyDrawController@EmptyList')->name('luckys.empty_list_download');
Route::get('lucky/empty-list/{amount}','LuckyDrawController@EmptyList');
Route::get('lucky/find/','LuckyDrawController@find')->name('lucky.find');
Route::get('lucky/search','LuckyDrawController@search')->name('lucky.search');
Route::get('lucky/count','LuckyDrawController@invoiceCount')->name('lucky.count');
Route::resource('lucky',LuckyDrawController::class);
Route::get('luckiest/ajax-search',[\App\Http\Controllers\Back\LuckyDrawController::class,'ajaxSearch'])
    ->name('luckiest.search');
