<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\User\src\Http\Controllers'], function () {
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', 'UserController@index')->name('admin.users.index');

            Route::get('create', 'UserController@create')->name('admin.users.create');
        });
    });
});