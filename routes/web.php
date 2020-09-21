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
    return view('welcome');
});

Route::get('task1', 'HomeController@integerConversionView')->name('task1');
Route::post('task1', 'HomeController@integerConversionHandler')->name('conversion_handler');

Route::get('task2', 'HomeController@recentlyConvertedIntegers')->name('task2');
Route::get('task3', 'HomeController@topTenConvertedIntegers')->name('task3');
