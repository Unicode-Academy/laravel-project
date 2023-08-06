<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return '<h1>Home</h1>';
})->name('home');
