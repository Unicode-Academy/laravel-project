<?php

use Illuminate\Support\Facades\Route;

//Auth::routes();

Route::get('/login', "Admin\LoginController@showLoginForm")->name('login');

Route::post('/login', "Admin\LoginController@login")->name('login');

Route::post('/logout', 'Admin\LoginController@logout')->name('logout');

Route::get('/dang-nhap', 'Clients\LoginController@showLoginForm')->name('clients.login');

Route::post('/dang-nhap', 'Clients\LoginController@login');
Route::get('/dang-ky', 'Clients\RegisterController@showRegistrationForm')->name('clients.register');
