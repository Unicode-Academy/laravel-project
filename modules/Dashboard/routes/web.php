<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
});
