<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\User;

class IndexController extends Controller
{

  private $friendList = null;
  private $postByFriend = [];
  private $scoreInteractive;

  public function index(Request $request) {
    $auth = Auth::user();
    $data = [];
    $data['albums'] = [];

    if(!Auth::check()) {
      return view('helloworld');
    }

    if($request->get('skip') == 'yes') {
      $u = User::find($auth->id);
      $u->skip_add_info = 1;
      $u->save();
      return redirect()->route('index');
    }

    if($auth->address == null && $auth->skip_add_info == 0) {
      return view('add-info-after-register');
    }

    /* covert json to array */
    $arrFriends = json_decode($auth->friends, true);
    /* get array id friends */
    $friends = array_keys($arrFriends);
    /* array score interactive */
    $this->scoreInteractive = array_values($arrFriends);
    /* array object friend list */
    $this->friendList = User::find($friends);
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
    /* all album */
    foreach ($auth->album as $v) {
      $data['albums'][$v['id']] = $v['album_name'];
    }
    /* bind data to view */
    $data['posts'] = $this->postByFriend;
    $data['suggest'] = $this->suggestFriend($auth);
    $data['friends'] = $this->friendList;
    return view('news-feed', $data);
  }

  private function suggestFriend($auth) {
    $suggest = [];
    $fr = array_keys(json_decode($auth->friends, true));
    if(count($fr <= 10)) {
      $allRecord = User::all();
      if($allRecord->count() == 0) {
        $suggest = [];
      }else{
        $suggest = User::where('address', 'LIKE', '%'.$auth->address.'%')
                        ->where('id', '<>', $auth->id)
                        ->where('friends','NOT LIKE', '%'.$auth->id.'%')->take(10)->get();
        if($suggest->count() == 0) {
          $suggest = User::where('id', '<>', $auth->id)
                        ->where('friends','NOT LIKE', '%'.$auth->id.'%')->take(10)->get();
        }
      }
    }
    return $suggest;
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
