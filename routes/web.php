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

Route::get('/', 'PageController@index')->name('add.item');
Route::get('/add-item', 'PageController@addItem')->name('add.item');
Route::get('/add-outfit', 'PageController@addOutfit')->name('add.outfit');
Route::get('/add-schedule', 'PageController@addSchedule')->name('add.schedule');
Route::get('/outfits', 'PageController@outfits')->name('outfits');
Route::get('/o/{id}', 'PageController@outfit')->name('view.outfit');

Route::post('/store-item', 'ActionsController@storeItem')->name('store.item');
Route::post('/store-media', 'ActionsController@storeMedia')->name('store.item');
Route::post('/store-outfit', 'ActionsController@storeOutfit')->name('store.outfit');
Route::post('/store-schedule', 'ActionsController@storeSchedule')->name('store.schedule');
Route::get('/images', 'ActionsController@getImages')->name('get.images');
Route::post('/scrape', 'ScraperController@scrape')->name('get.scrape');
Route::get('/sign_auth', 'ActionsController@signAuth');