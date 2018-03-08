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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/**
 * Authenticated routes
 */
Route::group(['middleware' => ['auth']], function () {

    /**
     * Spotify routes
     */
    Route::get('/spotify', 'SocialiteController@redirectToProvider')->name('spotify.redirect');
    Route::get('/spotify/callback', 'SocialiteController@handleProviderCallback')->name('spotify.callback');
    Route::get('/home', 'WebController@index')->name('home');

    /**
     * Other routes
     */
    Route::group(['middleware' => ['spotify']], function () {

        /**
         * Web routes
         */


        /**
         * API routes
         */
        Route::group(['prefix' => '/api'], function () {
            Route::get('/me', 'RequestController@getSpotifyUser');
            Route::get('/search', 'RequestController@searchsong');
        });
    });
});
