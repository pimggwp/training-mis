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

Route::resource('product','ProductController');
Route::resource('user','UserController');
Route::resource('transaction','TransactionController');
Route::resource('transaction-staff','TransactionSelectController');
Route::resource('transaction-gen','TransactionGenController');
Route::resource('reportuser','ReportUserController');
Route::resource('salereport','SaleReportController');
Route::resource('dividend-for-admin','DividendAdminController');
Route::resource('dividend-for-user','DividendUserController');
Route::resource('event','EventController');
Route::resource('profile','ProfileController');


Route::get('send-main', 'HomeController@sendMail');