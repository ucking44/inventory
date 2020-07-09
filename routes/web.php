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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('master/vendor', 'Master\VendorController');
Route::get('vendor/datatable', 'Master\VendorController@datatable')->name('vendor/datatable');

Route::resource('master/product', 'Master\ProductController');
Route::get('product/datatable', 'Master\ProductController@datatable')->name('product/datatable');
Route::get('product/datatableTrash', 'Master\ProductController@datatableTrash')->name('product/datatableTrash');
Route::post('product/undoTrash/{id}', 'Master\ProductController@undoTrash')->name('product/undoTrash');
Route::get('master/product/history/{id}', 'Master\ProductController@history')->name('master/product/history/{id}');

Route::resource('transaction/purchase-order', 'Transaction\PurchaseController');
Route::get('transaction/purchase-order/vendor/popup_media', 'Transaction\PurchaseController@popup_media_vendor')->name('transaction/purchase-order/vendor/popup_media');
Route::get('transaction/purchase-order/product/popup_media/{id_count}', 'Transaction\PurchaseController@popup_media_product')->name('transaction/purchase-order/product/popup_media');
Route::get('browse-product/datatable', 'Master\ProductController@datatable_product')->name('browse-product/datatable');
Route::get('browse-vendor/datatable', 'Master\VendorController@datatable_vendor')->name('browse-vendor/datatable');
Route::get('purchase-order/datatable', 'Transaction\PurchaseController@datatable')->name('purchase-order/datatable');
Route::post('transaction/purchase-order/receive/{id}', 'Transaction\PurchaseController@received')->name('transaction/purchase-order/receive/{id}');

Route::resource('transaction/sales', 'Transaction\SaleController');
Route::get('transaction/sales/product/popup_media/{id_count}', 'Transaction\SaleController@popup_media_product')->name('transaction/sales/vendor/popup_media');
Route::get('sales/datatable', 'Transaction\SaleController@datatable')->name('sales/datatable');
Route::get('transaction/sales/print/{id}', 'Transaction\SaleController@print')->name('transaction/sales/print');
//Route::resource('transaction/stock', 'Transaction\StockController');
Route::get('transaction/stock', 'Transaction\StockController@index')->name('transaction/stock');
Route::get('/transaction/stock/product/popup_media', 'Transaction\StockController@popup_media_product')->name('transaction/stock/product/popup_media');
Route::post('transaction/stock', 'Transaction\StockController@update')->name('transaction/stock');
Route::get('stock/report', 'Transaction\StockController@report')->name('stock/report');
