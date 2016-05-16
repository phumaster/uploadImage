<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class FeaturesController extends Controller
{
    public function index() {
      $friends = Auth::user()->friends;
      $postByFriend = [];
      if(!is_null($friends)) {
        $friendList = User::find(json_decode($friends));
        foreach ($friendList as $friend) {
          $posts = $friend->images()->paginate(5);
          foreach($posts as $post) {
            $postByFriend[] = $post;
          }
        }
        // sort
        $length = count($postByFriend);
        for($i = 0; $i < $length; $i++) {
          for($j = $length - 1; $j > $i; $j--) {
            $timestamp = strtotime($postByFriend[$j]->created_at);
            $timestamp2 = strtotime($postByFriend[$j - 1]->created_at);
            if($timestamp > $timestamp2) {
              $tmp = $postByFriend[$j];
              $postByFriend[$j] = $postByFriend[$j - 1];
              $postByFriend[$j - 1] = $tmp;
            }
          }
        }
      }else{
        $postByFriend = null;
      }
      $data['posts'] = $postByFriend;
      return view('features', $data);
    }
}
