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

Route::get('/', 'kendali_website@home');

Route::get('/signup', 'kendali_website@halamanSignup');

Route::get('/loginaccount', 'kendali_website@halamanLogin');
Route::post('/loginaccount/check', 'kendali_website@checkLogin');
Route::get('/sukses', 'kendali_website@sukses');
Route::get('/logout', 'kendali_website@logout');

Route::post('/updatedata', 'kendali_website@changeData');

Route::get('/test', 'kendali_website@create');

Route::post('/posts', 'kendali_website@daftarAkun');

Route::post('/sendFeedback', 'kendali_website@sendFeedback');

Route::get('/menu', 'kendali_website@menuPage');
Route::post('/menu/search', 'kendali_website@menuPageSearch');

Route::get('/addCart/{id}', 'kendali_website@addCart');
Route::delete('/cart/delete/{id}', 'kendali_website@deleteCart');

Route::get('/checkout/{total}', 'kendali_website@checkout');

Route::get('/cart', 'kendali_website@cart');

Route::get('/admin', 'kendali_website@admin');

Route::get('/deleteMenu/{id}', 'kendali_website@deleteMenu');
Route::get('/deleteFeedback/{id}', 'kendali_website@deleteFeedback');
Route::post('/newMenu', 'kendali_website@newMenu');
Route::get('/editMenu/{id}', 'kendali_website@editMenu');
Route::put('/edited/{id}', 'kendali_website@editedMenu');
Route::get('/feedback', 'kendali_website@feedback');

// Package Tambahan dari Laravel
Auth::routes();

