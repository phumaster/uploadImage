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
    if(\Auth::check()) {
      return view('helloworld');
    }
    return view('non-authorize');
});

Route::group(['prefix' => 'admin'], function(){
  Route::get('/', function(){
    return public_path();
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

/*
* @Image router
*/

Route::group(['prefix' => 'image'], function() {
  Route::get('/', [
    'as' => 'image.index',
    'uses' => 'ImageController@index'
  ]);

  Route::post('/', [
    'as' => 'image.store',
    'uses' => 'ImageController@store'
  ]);

  Route::get('/upload', [
    'as' => 'image.create',
    'uses' => 'ImageController@create'
  ]);

  Route::get('/{user}/{id}', [
    'as' => 'image.show',
    'uses' => 'ImageController@show'
  ])->where(['id' => '[0-9]+']);

  Route::put('/{user}/{id}', [
    'as' => 'image.update',
    'uses' => 'ImageController@update'
  ])->where(['id' => '[0-9]+']);

  Route::delete('/{id}', [
    'as' => 'image.destroy',
    'uses' => 'ImageController@destroy'
  ])->where(['id' => '[0-9]+']);

  Route::get('/{id}/edit', [
    'as' => 'image.edit',
    'uses' => 'ImageController@edit'
  ]);

  Route::post('/{user}/{id}/comment', [
    'as' => 'image.comment',
    'uses' => 'CommentImageController@postComment'
  ]);
});

/*
* @Album router
*/

Route::group(['prefix' => 'album'], function() {
  Route::get('/', [
    'as' => 'album.index',
    'uses' => 'AlbumController@index'
  ]);

  Route::post('/', [
    'as' => 'album.store',
    'uses' => 'AlbumController@store'
  ]);

  Route::get('/create', [
    'as' => 'album.create',
    'uses' => 'AlbumController@create'
  ]);

  Route::get('/{id}', [
    'as' => 'album.show',
    'uses' => 'AlbumController@show'
  ])->where(['id' => '[0-9]+']);

  Route::put('/{id}', [
    'as' => 'album.update',
    'uses' => 'AlbumController@update'
  ])->where(['id' => '[0-9]+']);

  Route::delete('/{id}', [
    'as' => 'album.destroy',
    'uses' => 'AlbumController@destroy'
  ])->where(['id' => '[0-9]+']);

  Route::get('/{id}/edit', [
    'as' => 'album.edit',
    'uses' => 'AlbumController@edit'
  ])->where(['id' => '[0-9]+']);

  Route::post('/{user}/{id}/comment', [
    'as' => 'album.comment',
    'uses' => 'CommentAlbumController@postComment'
  ]);
});
