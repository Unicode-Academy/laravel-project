<?php

use Modules\Student\src\Http\Controllers\StudentController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', 'StudentController@index')->name('index');

        Route::get('data', 'StudentController@data')->name('data');

        Route::get('create', 'StudentController@create')->name('create');

        Route::post('create', 'StudentController@store')->name('store');

        Route::get('edit/{student}', 'StudentController@edit')->name('edit');

        Route::put('edit/{student}', 'StudentController@update')->name('update');

        Route::delete('delete/{student}', 'StudentController@delete')->name('delete');
    });
});

Route::group(['as' => 'students.'], function () {
    Route::get('/tai-khoan', 'Clients\AccountController@index')->name('account');
    Route::get('/tai-khoan/thong-tin', 'Clients\AccountController@profile')->name('account.profile');
    Route::get('/tai-khoan/khoa-hoc', 'Clients\AccountController@myCourses')->name('account.courses');
    Route::get('/tai-khoan/don-hang', 'Clients\AccountController@myOrders')->name('account.orders');
    Route::get('/tai-khoan/doi-mat-khau', 'Clients\AccountController@changePassword')->name('account.password');
});
