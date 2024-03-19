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