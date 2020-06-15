<?php
Route::post('admin/register-user','Admin\UserController@saveUserData')->name('user.register');
Route::post('admin/job','Admin\JobController@store')->name('job.store');
Route::delete('admin/job/{job}','Admin\JobController@destroy')->name('job.delete');
Route::resource('course','Admin\CourseController');
Route::resource('student','Admin\StudentController');
