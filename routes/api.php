<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function () {

  Route::any('/shots.get', 'Shots@get');
  Route::any('/shots.recent', 'Shots@recent');
  Route::any('/shots.popular', 'Shots@popular');
  Route::any('/shots.followings', 'Shots@followings');
  Route::any('/shots.gaining', 'Shots@gaining');
  Route::any('/shots.search', 'Shots@search');

  Route::any('/users.get', 'Users@get');
  Route::any('/users.shots', 'Users@shots');
  Route::any('/users.likes', 'Users@likes');
  Route::any('/users.followers', 'Users@followers');
  Route::any('/users.followings', 'Users@followings');
  Route::any('/users.search', 'Users@search');

  Route::any('/likes.like', 'Likes@like');

  Route::any('/follows.toggle', 'Follows@follow');

  Route::any('/comments.shotComments', 'Comments@shotComments');
  Route::any('/comments.userComments', 'Comments@userComments');
  Route::any('/comments.create', 'Comments@create');

  Route::any('/settings.{query}', 'Settings@init');
});
