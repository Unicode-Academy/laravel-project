<?php
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::prefix('lessons')->name('lessons.')->group(function () {
        Route::get('/{courseId}', "LessonController@index")->name('index');
    });
});
