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
    public function index(Request $request, $user, $id) {
      if(!$request->ajax()) {
        return redirect()->back();
      }
      $image = Image::where(['id' => $id, 'user_id' => $user]);
      if(count($image->get()) == 0) {
        return json_encode(['error' => 1, 'message' => 'The post is not exists!']);
      }
      $like = $image->get()->like + 1;
      // $disLike = true;
      if($image->update(['like' => $like])) {
        if(isset($disLike) && $disLike) {
          return json_encode(['error' => 0, 'message' => 'You don\'t like this']);
        }
        return json_encode(['error' => 0, 'message' => 'You like this']);
      }
    }
}
