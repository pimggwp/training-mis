<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('user','UserController');
Route::resource('event','EventController');
Route::resource('profile','ProfileController');
Route::resource('training-save','TrainingSaveController');
Route::resource('employee','EmployeeController');
Route::resource('personal-report','PersonalReportController');
Route::resource('course','CourseController');
Route::resource('summary-report','EmployeesEventsController');

Route::get('send-main', 'HomeController@sendMail');