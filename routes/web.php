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
Route::get('/admindashboard','EventController@getAdminDashboard')->name('admin.dashboard');
Route::get('/feedbackdashboard','EventController@getFeedbackDashboard')->name('feedback.dashboard');
Route::get('/feedback_result/{event_id}','EventController@getFeedbackResult')->name('feedback.result');
/**/
Route::resource('events','EventController');

/**For Authentication

// Authentication Routes...*/
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

/**/
