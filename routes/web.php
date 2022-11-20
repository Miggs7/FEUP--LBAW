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
Route::post('/user/{id}/edit','UserController@updateUser')->name('edit');
Route::post('/user/{id}/ban','UserController@ban');

//auction
Route::get('/auction/{id}',function(){
    return view('pages.auction');
});
Route::post('/auction/{id}/bid', 'AuctionController@bid');
Route::post('/auction/{id}/edit', 'AuctionController@updateAuction');
Route::post('/auction/{id}/delete', 'AuctionController@delete');

//Manager
Route::get('/manager/{id}',function(){
    return view('pages.manager');
});

//Route::post('/bid', 'AuctionController@bid')->name('bid');
//Route::post('/update', 'AuctionController@updateAuction')->name('updateAuction');

// Cards
/*Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');
*/

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

/*Route::get('/manager_login',function(){
    return view('auth.loginManager');
});*/

//Route::post('/manager_login', 'Auth\LoginControllerManager@login');
//Route::get('/manager_logout', 'Auth\LoginControllerManager@logout')->name('manager.logout');
