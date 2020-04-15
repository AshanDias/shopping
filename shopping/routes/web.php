<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/product/get','ProductController@index')->name('getProduct');
Route::post('/saveProduct','ProductController@store')->name('saveProduct');
Route::get('/product/details','ProductController@getProuctDetails')->name('productDetails');
Route::get('/product/moreDetails/{id}','ProductController@details')->name('productDetailsGetId');

//session handle cart

Route::post('/userSaveSession','SessionController@store')->name('saveSession');
Route::get('/session/getCartBySessionId/{id}','SessionController@getSession')->name('getSession');