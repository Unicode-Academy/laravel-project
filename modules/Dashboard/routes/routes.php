<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\Dashboard\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    });
});
