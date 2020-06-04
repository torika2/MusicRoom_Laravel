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

Route::get('/','admin\ClientPagesController@welcome')->name('welcome_page');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

		//ADMIN 
Route::get('/admin','admin\PageController@adminHome')->name('adminHome');
Route::get('/admin/profile','admin\PageController@adminProfile')->name('adminProfile');
//ADMIN INSTRUMENT
Route::get('/admin/instrument','admin\PageController@adminInstrument')->name('adminInstrument');
		//ADMIN-ADDcategory
Route::post('/admin/add/instrument/category','admin\PageController@add_instrument_category')->name('add_instrument_category');
		//ADMIN-GETcategory
Route::get('/admin/get/instrument/category','admin\PageController@get_instrument_category')->name('get_instrument_category');
		//ADMIN-ADDmodel
Route::post('/admin/add/instrument/model','admin\PageController@add_instrument_model')->name('add_instrument_model');
		//ADMIN-GETmodel
Route::post('/admin/get/instrument/model','admin\PageController@get_instrument_model')->name('get_instrument_model');
		//ADMIN-GETinstrument
Route::get('/admin/get/insturment','admin\PageController@get_all_insturment')->name('get_all_insturment');
		//ADMIN-ADDinstrument
Route::post('/admin/add/instrument','admin\PageController@add_instrument')->name('add_instrument');
		// ADMIN-DELETEinstrument
Route::post('/admin/delete/instrument','admin\PageController@delete_instrument')->name('delete_instrument');
		// ADMIN-post_page
Route::get('/admin/post','admin\PostController@adminPostPage')->name('adminPostPage');
		






		//ADMIN POST
// ADMIN-ADDmusicgenre
Route::post('/admin/post/create/genre','admin\PostController@add_music_genre')->name('add_music_genre');
// ADMIN-GETgenres(ajax)
Route::get('/admin/get/genre','admin\PostController@get_genres')->name('get_genres');
// ADMIN-ADDpost(ajax)
Route::post('/admin/add/post','admin\PostController@add_post')->name('add_post');
// ADMIN-GETpost(ajax)
Route::get('/admin/get/post','admin\ClientPagesController@get_post')->name('get_post');