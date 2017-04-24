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

Route::get('/', 'IndexController@index')->name('home');
Route::get('/getPosition', 'IndexController@getPosition');
Route::get('/setPosition', 'IndexController@setPosition');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/confirm/{id}', 'AdminController@confirm')->name('confirm');
Route::get('/delete/{id}', 'AdminController@delete')->name('delete');
