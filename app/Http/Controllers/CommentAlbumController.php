<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests
use App\Http\Requests\PostCommentAlbumRequest;

// use models
use Auth;
use App\Comment_album;

class CommentAlbumController extends Controller
{
  public function __construct() {
    $this->middleware('auth');
  }

  public function postComment(PostCommentAlbumRequest $request, $user, $id) {
    $data = [
      'comment_status' => 1,
      'user_id' => Auth::user()->id,
      'album_id' => $id
    ];

    if(Comment_album::create(array_merge($data, $request->only('comment_content')))) {
      return redirect()->route('album.show', [$user, $id])->with(['message' => 'Your comment has been post']);
    }
    return redirect()->route('album.show', [$user, $id])->withErrors('Unexpected error!');
  }
}
