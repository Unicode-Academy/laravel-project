<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', 'CoursesController@index')->name('index');

        Route::get('data', 'CoursesController@data')->name('data');

        Route::get('create', 'CoursesController@create')->name('create');

        Route::post('create', 'CoursesController@store')->name('store');

        Route::get('edit/{course}', 'CoursesController@edit')->name('edit');

        Route::put('edit/{course}', 'CoursesController@update')->name('update');

        Route::delete('delete/{course}', 'CoursesController@delete')->name('delete');
    });
});
