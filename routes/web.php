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
Route::put('/user/{id}/edit','UserController@updateUser')->name('edit');
Route::put('/user/{id}/ban','UserController@ban');

//auction
Route::get('/auction/{id}',function(){
    return view('pages.auction');
});
Route::put('/auction/{id}/bid', 'AuctionController@bid');
Route::put('/auction/{id}/edit', 'AuctionController@updateAuction');
Route::delete('/auction/{id}/delete', 'AuctionController@delete');

//Manager
Route::get('/manager/{id}',function(){
    return view('pages.manager');
});

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

