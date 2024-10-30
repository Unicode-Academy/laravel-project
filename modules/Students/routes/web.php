<?php
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
    Route::group(['prefix' => 'tai-khoan', 'as' => 'account.', 'middleware' => ['auth:students', 'verified', 'user.block']], function () {
        Route::get('/', 'Clients\AccountController@index')->name('index');
        Route::get('/thong-tin', 'Clients\AccountController@profile')->name('profile');
        Route::post('/thong-tin', 'Clients\AccountController@updateProfile')->name('update-profile');
        Route::get('/khoa-hoc', 'Clients\AccountController@myCourses')->name('courses');
        Route::get('/don-hang', 'Clients\AccountController@myOrders')->name('orders');
        Route::get('/don-hang/{id}', 'Clients\AccountController@orderDetail')->name('order-detail');
        Route::get('/doi-mat-khau', 'Clients\AccountController@changePassword')->name('password');
        Route::post('/doi-mat-khau', 'Clients\AccountController@updatePassword');

        Route::get('/thanh-toan/{id}', 'Clients\CheckoutController@index')->name('checkout');

        Route::prefix('/coupon')->group(function () {
            Route::post('/verify', 'Clients\CouponController@verify');
            Route::post('/remove', 'Clients\CouponController@remove');
        });
    });
});
