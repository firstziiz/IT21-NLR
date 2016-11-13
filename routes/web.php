<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => 'web'], function () {
  Route::get('/','HomeController@index');

  // facebook OAuth
  Route::get('/signin-facebook', 'Auth\RegisterController@redirectToFacebookProvider');
  Route::get('/signin-facebook-callback', 'Auth\RegisterController@handleFacebookProviderCallback');
  // google OAuth
  Route::get('/signin-google', 'Auth\RegisterController@redirectToGoogleProvider');
  Route::get('/signin-google-callback', 'Auth\RegisterController@handleGoogleProviderCallback');

  // Authentication routes... added from the docs!
  Route::get('logout', 'Auth\LoginController@logout');

  Route::group(['middleware' => 'auth'], function () {

    // Reservation & Booking Routes
    Route::get('/reservation', 'ReserveController@index');
    Route::get('/booking/{id}', 'BookingController@index');
    Route::post('/booking/bookingseat', 'BookingController@bookingSeat');
    Route::post('/booking/cancelseat', 'BookingController@cancelSeat');

    // Profile Routes
    Route::get('/profile','ProfileController@index');

  });

});
