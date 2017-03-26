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


Route::get('/', 'PageController@home')->name('home');

Route::get('/search', 'PageController@search')->name('search');

Route::get('/pages/{page}', 'PageController@page')->name('page');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['namespace' => 'Auth', 'middleware' => 'previous'], function () {
    Route::get('/login', 'LoginController@show')->name('sign_in');
    Route::post('/login', 'LoginController@login')->name('sign_in_action');

    Route::get('/register', 'RegisterController@show')->name('sign_up');
    Route::post('/register', 'RegisterController@register')->name('sign_up_action');
});

Route::group(['middleware' => 'web', 'namespace' => 'App'], function () {

    Route::get('/add', 'ShotController@create')
        ->name('shot_create')
        ->middleware('auth');
    Route::post('/add', 'ShotController@createAction')
        ->name('shot_create_action')
        ->middleware('auth');

    Route::get('/settings', 'SettingController@show')
        ->name('settings')
        ->middleware('auth');

    Route::get('/shots/{shot}', 'ShotController@show')->name('shot');

    Route::get('/shots', 'ShotController@showAll')->name('shots');

    Route::get('/{username}', 'UserController@show')->name('user');
});
