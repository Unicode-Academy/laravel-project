<?php
Route::prefix('students')->name('students.')->group(function () {
   //Route here
   Route::post('/auto-pay', 'Api\PaymentController@autoPay');
   Route::get('/check-payment/{orderId}', 'Api\PaymentController@checkPayment');
});
