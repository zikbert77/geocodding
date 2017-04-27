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

Route::match(['get', 'post'], '/', 'IndexController@index')->name('home');
Route::get('/getPosition', 'IndexController@getPosition');
Route::get('/setPosition', 'IndexController@setPosition');


Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/confirm/{id}', 'AdminController@confirm')->name('confirm');
Route::get('/delete/{id}', 'AdminController@delete')->name('delete');
Route::match(['get', 'post'], '/update/{id}', 'AdminController@update')->name('update');

Route::get('auth/login', 'AuthController@getLoginPage')->name('loginPage');
Route::post('auth/login', 'AuthController@authenticate')->name('authenticate');
Route::get('auth/logout', 'AuthController@getLogout')->name('logout');