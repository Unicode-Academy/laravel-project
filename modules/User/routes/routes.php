<?php

use Illuminate\Support\Facades\Route;

//Module Users
Route::group(['namespace' => 'Modules\User\src\Http\Controllers'], function () {
    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index');

        Route::get('/detail/{id}', 'UserController@detail');

        Route::get('/create', 'UserController@create');
    });
});