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

Route::get('/', 'PagesController@getHome')->name('pages.home');
Route::get('/feedback', 'PagesController@getFeedback')->name('pages.getFeedback');
Route::post('/feedback','PagesController@postFeedback')->name('events.postFeedback');
/**/
Route::resource('events','EventController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
