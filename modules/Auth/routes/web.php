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