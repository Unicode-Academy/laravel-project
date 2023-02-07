<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Modules\Categories\src\Http\Controllers', 'middleware' => 'web'], function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', 'CategoriesController@index')->name('index');

            Route::get('data', 'CategoriesController@data')->name('data');

            Route::get('create', 'CategoriesController@create')->name('create');

            Route::post('create', 'CategoriesController@store')->name('store');

            Route::get('edit/{category}', 'CategoriesController@edit')->name('edit');

            Route::put('edit/{category}', 'CategoriesController@update')->name('update');

            Route::delete('delete/{category}', 'CategoriesController@delete')->name('delete');
        });
    });
});

Route::group(['prefix' => 'filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
