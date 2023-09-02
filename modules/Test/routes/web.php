<?php
Route::prefix('test')->name('test.')->group(function () {
    //Route here
    Route::get('/', function () {
        return 'hello test';
    });
});
