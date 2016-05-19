<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Comment_image;
use App\Image;

class LikeImageController extends Controller
{
    private $image;
    private $dislike = false;

    public function index(Request $request, $user, $id) {
      if(!$request->ajax()) {
        return redirect()->back();
      }
      $img = Image::where(['id' => $id, 'user_id' => $user]);
      if(count($img->get()) == 0) {
        return json_encode(['error' => 1, 'message' => 'The post is not exists!']);
      }
      $this->image = $img->first();
      if($this->updateLike($this->image->likes)) {
        if($this->dislike) {
          return json_encode(['error' => 0, 'message' => 'You don\'t like this photo', 'like' => 0, 'likeCount' => count(json_decode($this->image->likes, true))]);
        }
        return json_encode(['error' => 0, 'message' => 'You like this photo', 'like' => 1, 'likeCount' => count(json_decode($this->image->likes, true))]);
      }
      return 1;
    }

    private function updateLike($like = null) {
      if(is_null($like)) {
        $like = json_encode([Auth::user()->id]);
        if($this->image->update(['likes' => $like])) {
          return true;
        }
      }else{
        $like = json_decode($like, true);
        if(in_array(Auth::user()->id, $like)) {
          $likeNew = array_diff([Auth::user()->id], $like);
          if($this->image->update(['likes' => json_encode($likeNew)])) {
            $this->dislike = true;
            return true;
          }
        }
        $likeNew = array_merge([Auth::user()->id], $like);
        if($this->image->update(['likes' => json_encode($likeNew)])) {
          return true;
        }
      }
      return false;
    }
}
