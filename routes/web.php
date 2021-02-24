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


// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@search')->name('home');
// Route::get('/search', 'HomeController@search')->name('search-home');

Route::get('/bus-list', 'BusListController@index')->name('bus-list');
// Route::post('/bus-list', 'BusListController@search')->name('search');
Route::get('/view-bus', 'BusDetailController@index')->name('view-bus');
// Route::post('/view-bus/search1', 'BusListController@search')->name('view-bus-search');
Route::post('/list-bus/search', 'BusListController@search')->name('search-bus');
Route::get('/view-bus/{id}', 'BusDetailController@index')->name('bus-detail');
Route::get('/view-bus/pesanan/{id}', 'BusPesanController@index')->name('bus-pesanan');
Route::post('/view-bus/pesanan/order', 'BusPesanController@search')->name('order');

// Route::get('/bus-detail/{$id}', 'BusListController@detail')->name('bus-details');



Route::get('/bus-pesan', 'BusPesanController@index')->name('bus-pesan');
Route::get('/pesan-sukses', 'BusPesanController@sukses')->name('pesan-sukses');

// Auth::routes();

// test checout
Route::post('/checkout/{id}', 'BusPesanController@process')
    ->name('checkout_process');

Route::get('/checkout/{id}', 'BusPesanController@index')
    ->name('checkout');

Route::get('/checkout/confirm/{id}', 'BusPesanController@success')
    ->name('checkout-success');