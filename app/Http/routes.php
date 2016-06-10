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

// Index

Route::get('/', [
  'as' => 'index',
  'uses' => 'IndexController@index'
]);

Route::get('/founder', function() {
  return "A";
});

/*
* @Admin routes
*/

Route::group(['prefix' => 'admin'], function(){
  Route::get('/',[
    'uses' => 'Test@test'
  ]);
});

/*
* @Authentication routes
*/

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

Route::get('/messages', [
  'as' => 'messages',
  'uses' => 'MessageController@index'
]);

Route::get('/messages/{user}', [
  'as' => 'message.show',
  'uses' => 'MessageController@show'
]);

Route::post('/messages/to-{id}', [
  'as' => 'message',
  'uses' => 'MessageController@handle'
]);

Route::any('/pull', [
  'as' => 'pull.request',
  'uses' => 'PullRequestController@handle'
]);

/*
* @User profile routes
*/

Route::group(['prefix' => '/{user}'], function() {
  Route::get('/', [
    'as' => 'user.profile',
    'uses' => 'UserController@index'
  ]);

  Route::post('/add-friend', [
    'as' => 'add-friend',
    'uses' => 'FriendController@add'
  ]);

  Route::post('/add-info', [
    'as' => 'add-info',
    'uses' => 'AddInfoController@add'
  ]);

  Route::post('/update/profile_picture', [
    'as' => 'update.profile_picture',
    'uses' => 'ChangeImageProfileController@changeProfilePicture'
  ]);

  Route::post('/update/cover_photo', [
    'as' => 'update.cover_photo',
    'uses' => 'ChangeImageProfileController@changeCoverPhoto'
  ]);

  Route::get('/about', [
    'as' => 'user.about',
    'uses' => 'UserController@index'
  ]);

  /*
  * @Album routes
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
    ]);

    Route::put('/{id}', [
      'as' => 'album.update',
      'uses' => 'AlbumController@update'
    ])->where(['id' => '[0-9]+']);

    Route::delete('/{id}', [
      'as' => 'album.destroy',
      'uses' => 'AlbumController@destroy'
    ]);

    Route::get('/{id}/edit', [
      'as' => 'album.edit',
      'uses' => 'AlbumController@edit'
    ]);

    Route::post('/{id}/comment', [
      'as' => 'album.comment',
      'uses' => 'CommentAlbumController@postComment'
    ]);
  });


  /*
  * @Image routes
  */

  Route::group(['prefix' => 'photo'], function() {
    Route::get('/', [
      'as' => 'photo.index',
      'uses' => 'ImageController@index'
    ]);

    Route::post('/', [
      'as' => 'photo.store',
      'uses' => 'ImageController@store'
    ]);

    Route::get('/upload', [
      'as' => 'photo.create',
      'uses' => 'ImageController@create'
    ]);

    Route::get('/{id}', [
      'as' => 'photo.show',
      'uses' => 'ImageController@show'
    ]);

    Route::put('/{id}', [
      'as' => 'photo.update',
      'uses' => 'ImageController@update'
    ]);

    Route::delete('/{id}', [
      'as' => 'photo.destroy',
      'uses' => 'ImageController@destroy'
    ]);

    Route::get('/{id}/edit', [
      'as' => 'photo.edit',
      'uses' => 'ImageController@edit'
    ]);

    Route::post('/{id}/comment', [
      'as' => 'photo.comment',
      'uses' => 'CommentImageController@postComment'
    ]);

    Route::post('/{id}/like', [
      'as' => 'photo.like',
      'uses' => 'LikeImageController@index'
    ]);
  });
});
