<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function(){
  Route::get('/', function(){
    return 'Dashboard!';
  });
});

Route::get('/login', [
  'as' => 'login',
  'uses' => 'AuthenticationController@getLogin'
]);

Route::post('/login', [
  'uses' => 'AuthenticationController@postLogin'
]);

Route::get('/register', [
  'as' => 'register',
  'uses' => 'AuthenticationController@getRegister'
]);

Route::post('/register', [
  'uses' => 'AuthenticationController@postRegister'
]);

Route::get('/logout', [
  'as' => 'logout',
  'uses' => 'AuthenticationController@getLogout'
]);

Route::resource('image', 'ImageController');

Route::resource('album', 'AlbumController');
