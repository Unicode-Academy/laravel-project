<?php

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', 'UserController@index')->name('index');

        Route::get('data', 'UserController@data')->name('data');

        Route::get('create', 'UserController@create')->name('create');

        Route::post('create', 'UserController@store')->name('store');

        Route::get('edit/{user}', 'UserController@edit')->name('edit');

        Route::put('edit/{user}', 'UserController@update')->name('update');

        Route::delete('delete/{user}', 'UserController@delete')->name('delete');
    });
});
