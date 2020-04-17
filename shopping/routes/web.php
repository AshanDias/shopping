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

Route::get('/foo', function () {
    Artisan::call('storage:link');
    return "success";
});

Route::get('/product/get','ProductController@index')->name('getProduct');
Route::post('/saveProduct','ProductController@store')->name('saveProduct');
Route::get('/product/details','ProductController@getProuctDetails')->name('productDetails');
Route::get('/product/moreDetails/{id}','ProductController@details')->name('productDetailsGetId');
Route::post('/product/detailById','ProductController@getDetailsByID')->name('detailByID');

//session handle cart

Route::post('/userSaveSession','SessionController@store')->name('saveSession');
Route::get('/session/getCartBySessionId/{id}','SessionController@getSession')->name('getSession');
Route::post('/session/delete','SessionController@deleteSession')->name('deleteSession');
Route::get('/session/getProduct/{id}','SessionController@getSessionListById')->name('getSessionListById');

//order
Route::post('/order/save','OrderController@store')->name('saveOrder');
Route::get('/order/get','OrderController@index')->name('getOrder');
Route::post('/order/delever','OrderController@delever')->name('delever');