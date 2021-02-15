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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@search')->name('search-home');

Route::get('/bus-list', 'BusListController@index')->name('bus-list');
// Route::post('/bus-list', 'BusListController@search')->name('search');
Route::get('/view-bus', 'BusDetailController@index')->name('view-bus');
Route::get('/view-bus/search', 'BusListController@search')->name('search-bus');
Route::get('/view-bus/{id}', 'BusDetailController@index')->name('bus-detail');

// Route::get('/bus-detail/{$id}', 'BusListController@detail')->name('bus-details');



Route::get('/bus-pesan', 'BusPesanController@index')->name('bus-pesan');
Route::get('/pesan-sukses', 'BusPesanController@sukses')->name('pesan-sukses');

// Auth::routes();