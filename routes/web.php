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


Route::get('/home', 'HomeController@laravel')->name('laravel-home');

// Home
Route::get('/', 'HomeController@search')->name('home');

// view bus
Route::get('/bus-list', 'BusListController@index')->name('bus-list');
Route::get('/view-bus', 'BusDetailController@index')->name('view-bus');

// bus search
Route::post('/list-bus/search', 'BusListController@search')->name('search-bus');

// bus detail
Route::get('/view-bus/{id}', 'BusDetailController@index')->name('bus-detail');

Route::group(['middleware' => ['auth']], function () {
    // bus Pesanan
    Route::post('/checkout/{id}', 'BusPesanController@process')
        ->name('checkout_process');

    Route::get('/checkout/{id}', 'BusPesanController@index')
        ->name('checkout');

    // bus pesanan order dibuat 
    Route::get('/checkout/confirm/{id}', 'BusPesanController@success')
        ->name('checkout-success');

    // Payment dan upload transaksi
    Route::get('/checkout/payment/{id}', 'PaymentUploadController@index')
        ->name('payment-checkout');

    Route::post('/checkout/payment/{id}', 'PaymentUploadController@process')
        ->name('payment-process');

    // upload gambar
    Route::post('/checkout/payment/transfer/upload', 'PaymentUploadController@uploadGallery')
        ->name('payment-transfer-upload');
    Route::post('/checkout/payment/transfer/delete/{id}', 'PaymentUploadController@deleteGallery')
        ->name('payment-transfer-delete');

    // manifest Tiket

    Route::get('/manifest/{id}', 'ManifestController@index')
        ->name('manifest');
    Route::post('/manifest/proses/{id}', 'ManifestController@process')
        ->name('manifest-proses');
    Route::get('/manifest/sukses/{id}', 'ManifestController@success')
        ->name('manifest-sukses');

    // tampilan sukses
    Route::get('/sukses/{id}', 'ManifestController@sukses')
        ->name('sukses');
    // tampilan cart
    Route::get('/cart', 'CartController@index')
        ->name('cart');

});



// Route::get('/view-bus/pesanan/{id}', 'BusPesanController@index')->name('bus-pesanan');
// Route::post('/view-bus/pesanan/order', 'BusPesanController@search')->name('order');



Route::get('/bus-pesan', 'BusPesanController@index')->name('bus-pesan');
Route::get('/pesan-sukses', 'BusPesanController@sukses')->name('pesan-sukses');

Auth::routes();

// test checout


