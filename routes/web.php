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
//Home
Route::get('/', function () {
    return view('pages.home');
});

//FAQ
Route::get('/faq', function() {
    return view('pages.faq');
});

//Contact
Route::get('/contact', function() {
    return view('pages.contact');
});

//about
Route::get('/about', function() {
    return view('pages.about');
});

//user
Route::get('/user/{id}',function(){
    return view('pages.user');
});

//auction
Route::get('/auction/{id}',function(){
    return view('pages.auction');
});
Route::post('/bid', 'AuctionController@bid')->name('bid');

//User
Route::post('/edit','UserController@updateUser')->name('edit');

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
