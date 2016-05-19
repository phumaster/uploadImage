<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests
use App\Http\Requests\PostCommentImageRequest;

// use models
use Auth;
use App\Image;
use App\Comment_image;

class CommentImageController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function postComment(PostCommentImageRequest $request, $user, $id) {
      $image = Image::where(['id' => $id, 'user_id' => $user]);
      if(count($image->get()) == 0) {
        if($request->ajax()) {
          return json_encode(['error' => 1, 'message' => 'Opps! Cann\'t post your comment! Maybe photo has been delete!']);
        }
        return redirect()->route('image.show', [$user, $id])->withErrors('The photo does not exist!');
      }
      $data = [
        'comment_status' => 1,
        'user_id' => \Auth::user()->id,
        'image_id' => $id
      ];

      if(Comment_image::create(array_merge($request->except('_token'), $data))) {
        if($request->ajax()) {
          return json_encode(['error' => 0, 'message' => 'You said: '.$request->get('comment_content'), 'commentCount' => $image->first()->comments()->count()]);
        }
        return redirect()->route('image.show', [$user, $id])->with(['message' => 'Your comment has been post']);
      }
      if($request->ajax()) {
        return json_encode(['error' => 1, 'message' => 'Opps! Cann\'t post your comment! Maybe photo has been delete!']);
      }
      return redirect()->route('image.show', [$user, $id])->withErrors('Unexpected errors');
    }
}
