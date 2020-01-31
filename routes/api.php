<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('product','Api\ProductController');
Route::resource('user','Api\UserController');
Route::resource('transaction','Api\TransactionController');
Route::resource('reportuser','Api\ReportUserController');
Route::resource('event','Api\EventController');
Route::resource('course','Api\CourseController');