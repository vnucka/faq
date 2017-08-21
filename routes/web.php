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

Route::get('/', 'MainPageController@viewMainPage')->name('MainPage');

Route::get('/home', 'FaqController@home')->name('home');
Route::post('/admQuestion', 'FaqController@admQuestion')->name('admQuestion');
Route::get('/faq-reply', 'FaqController@faqReply')->name('faqReply');
Route::get('/faq-create', 'FaqController@faqCreate')->name('faqCreate');
Route::get('/users', 'UserController@users')->name('users');
Route::match(['get', 'post'], '/userEdit', 'UserController@userEdit')->name('userEdit');

Route::get('/themes', 'FaqController@themes')->name('themes');
Route::match(['get','post'], '/themeEdit', 'FaqController@themeEdit')->name('themeEdit');
Route::match(['get','post'], '/themeAdd', 'FaqController@themeAdd')->name('themeAdd');

Route::post('/createQuestion', 'FaqController@createQuestion')->name('createQuestion');
Route::get('/createQuestion', function (){
    return view('bed-reg');
});

Route::match(['get', 'post'], '/editQuestion', 'FaqController@editQuestion')->name('editQuestion');

Route::post('/createAnswer', 'FaqController@createAnswer')->name('createAnswer');
Route::get('/createAnswer', function (){
    return view('bed-reg');
});

Route::match(['get', 'post'],'/changePassword', 'UserController@changePassword')->name('changePassword');

Route::get('/bed-reg', function (){
    return view('bed-reg');
});

Route::get('/404', function (){
  return dd('bed request');
});

Auth::routes();



