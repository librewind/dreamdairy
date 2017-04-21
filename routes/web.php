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

Auth::routes();

// Главная
Route::get('/',     'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

// Профиль
Route::get(                    'profile',      'ProfileController@show');
Route::get(                    'profile/edit', 'ProfileController@edit');
Route::match(['put', 'patch'], 'profile',      'ProfileController@update');

// Сны
Route::resource('dreams', 'DreamController');