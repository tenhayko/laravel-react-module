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

Route::name('admin')->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('.dashboard');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('.login.submit');
    Route::post('/logout','Auth\AdminLoginController@logout')->name('.logout');
});