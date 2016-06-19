<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use App\FriendShip;

class FriendController extends Controller
{
  protected $user = null;

  public function add(Request $request, $user) {
    $this->user = $user;

    if(!$request->ajax()) {
      return redirect()->route('index');
    }
    if($this->isAddYourself()) {
      return json_encode(['error' => 1]);
    }
    if(Auth::user()->isFriend($this->user)) {
      return json_encode(['error' => -1]);
    }
    if(Auth::user()->isSentRequest($user)) {
      return json_encode(['error' => -2]);
    }else{
      if(FriendShip::create(['from' => Auth::user()->id, 'to' => $this->user])) {
        return json_encode(['error' => 0]);
      }
      return json_encode(['error' => 1]);
    }
  }

  public function accept(Request $request, $user) {
    return $request->all();
  }

  private function isAddYourself() {
    return Auth::user()->id == $this->user;
  }
}
