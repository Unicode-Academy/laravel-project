<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

//Auth::routes();

Route::get('/login', "Admin\LoginController@showLoginForm")->name('login');

Route::post('/login', "Admin\LoginController@login")->name('login');

Route::post('/logout', 'Admin\LoginController@logout')->name('logout');

Route::get('/dang-nhap', 'Clients\LoginController@showLoginForm')->name('clients.login');

Route::post('/dang-nhap', 'Clients\LoginController@login');
Route::get('/dang-ky', 'Clients\RegisterController@showRegistrationForm')->name('clients.register');
Route::post('/dang-ky', 'Clients\RegisterController@register');
Route::post('/dang-xuat', 'Clients\LoginController@logout')->name('clients.logout');
Route::get('/block', 'Clients\BlockController@index')->name('clients.block.index')->middleware('auth:students');

Route::get('/email/verify', 'Clients\VerifyController@index')->middleware('auth:students')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('home');
})->middleware(['auth:students', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', 'Clients\VerifyController@resend')->middleware(['auth:students', 'throttle:6,1'])->name('verification.send');

Route::get('/quen-mat-khau', 'Clients\LoginController@showFormForgot')->name('clients.password.forgot');
Route::post('/quen-mat-khau', 'Clients\LoginController@handleSendForgotLink');

Route::get('/dat-lai-mat-khau/{token}', 'Clients\LoginController@showFormReset')->middleware('guest')->name('password.reset');
