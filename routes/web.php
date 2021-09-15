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
Route::get('/user/{any?}', function () {
    return view('user');
})->where('any', '.*');

Route::resource('/ajax/user/item', 'Ajax\User\ItemController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/const', 'ConstController');
