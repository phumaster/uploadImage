<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests
use App\Http\Requests\PostCommentImageRequest;

// use models
use Auth;
use Comment_image;

class CommentImageController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function postComment(PostCommentImageRequest $request, $user, $id) {
      $data = [
        'comment_status' => 1,
        'user_id' => \Auth::user()->id,
        'image_id' => $id
      ];

      if(Comment_image::create(array_merge($request->except('_token'), $data))) {
        return redirect()->route('image.show', [$user, $id])->with(['message' => 'Your comment has been post']);
      }
      return redirect()->route('image.show', [$user, $id])->withErrors('Unexpected errors');
    }
}
