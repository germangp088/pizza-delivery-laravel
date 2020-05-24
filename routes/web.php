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

Route::get('/product', 'ProductController');
Route::get('/shipping_fee', 'ShippingFeeController');
Route::get('/currency', 'CurrencyController');
Route::post('/order', 'OrderController@create');
Route::get('/order/{ip}', 'OrderController@history');
