<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class FeaturesController extends Controller
{
    private $friendList = null;
    private $postByFriend = [];
    private $scoreInteractive;


    public function __construct() {
      /* covert json to array */
      $arrFriends = json_decode(Auth::user()->friends, true);
      /* get array id friends */
      $friends = array_keys($arrFriends);
      /* array score interactive */
      $this->scoreInteractive = array_values($arrFriends);
      /* array object friend list */
      $this->friendList = User::find($friends);
    }

    public function index() {
      if(!is_null(Auth::user()->friends)) {
        /*
        * Sort friends by score interactive
        */
        $this->sortFriendsListByScoreInteractive();
        /*
        * limit user to get post
        */
        $this->getLimitUser(10);
        /*
        * get post from friend list
        */
        $this->getPosts();
        /*
        * sort posts by time
        */
        $this->sortPostsByTime();
      } /* end is null friend */
      /* bind data to view */
      $data['posts'] = $this->postByFriend;
      return view('features', $data);
    }

    /* return void */
    private function sortFriendsListByScoreInteractive() {
      // sort by desc (selction sort)
      $l = count($this->scoreInteractive);
      for($i = 0; $i < $l - 1; $i++) {
        $m = $i;
        for($x = $i+1; $x < $l; $x++) {
          if($this->scoreInteractive[$i] < $this->scoreInteractive[$x]) {
            $m = $x;
          }
        }
        if($m != $i) {
          $t = $this->friendList[$i];
          $this->friendList[$i] = $this->friendList[$m];
          $this->friendList[$m] = $t;
        }
      }
    }

    /* return void */
    private function getLimitUser($limit = 10) {
      // limit $limit user
      if(count($this->friendList) > 0) {
        foreach ((array)$this->friendList as $k) {
          $this->friendList = array_slice((array)$k, 0, $limit);
        }
      }
    }

    /* return void */
    private function getPosts() {
      foreach ($this->friendList as $friend) {
        $posts = $friend->images()->paginate(5);
        foreach($posts as $post) {
          $this->postByFriend[] = $post;
        }
      }
    }

    /* return void */
    private function sortPostsByTime() {
      // sort by time post (bubble sort)
      if(count($this->postByFriend) > 0) {
        $length = count($this->postByFriend);
        for($i = 0; $i < $length; $i++) {
          for($j = $length - 1; $j > $i; $j--) {
            $timestamp = strtotime($this->postByFriend[$j]->created_at);
            $timestamp2 = strtotime($this->postByFriend[$j - 1]->created_at);
            if($timestamp > $timestamp2) {
              $tmp = $this->postByFriend[$j];
              $this->postByFriend[$j] = $this->postByFriend[$j - 1];
              $this->postByFriend[$j - 1] = $tmp;
            } // end if
          } // end for 2
        } // end for 1
      } // endif
    }
}
