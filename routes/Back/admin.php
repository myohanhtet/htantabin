<?php

use App\Http\Controllers\Back\DonorController;

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
Route::get('luckys/count','DashboardController@counts')->name('luckys.count');
Route::get('lucky_list','DashboardController@LuckyList')->name('luckys.list_download');
Route::get('empty_list','DashboardController@EmptyList')->name('luckys.empty_list_download');


Route::controller(DonorController::class)
    ->as('donors.')
    ->group(function () {
        Route::post('donors/upload','DonorController@upload')->name('upload');
        Route::get('donors/ajax-search','DonorController@ajaxSearch')->name('search.name');
    });
