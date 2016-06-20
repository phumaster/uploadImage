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
      $friendShip = FriendShip::where(['from' => $user, 'accepted' => 0])->first();
      if(count($friendShip) == 0) {
        return response()->json(['error' => 1, 'message' => 'Unexpected Error!']);
      }
      if($request->get('accept') == "yes") {
        $auth = User::find(Auth::user()->id);
        $userRequest = User::find($user);
        // handle add friend
        $keyFriend = array_merge(array_keys(json_decode($auth->friends, true)), [$user]);
        $valueFriend = array_merge(array_values(json_decode($auth->friends, true)), [0]);

        $keyFriend2 = array_merge(array_keys(json_decode($userRequest->friends, true)), [$auth->id]);
        $valueFriend2 = array_merge(array_values(json_decode($userRequest->friends, true)), [0]);
        //
        $auth->friends = json_encode(array_combine($keyFriend, $valueFriend));
        $auth->save();
        $userRequest->friends = json_encode(array_combine($keyFriend2, $valueFriend2));
        $userRequest->save();
        $friendShip->update(['accepted' => 1]);
        return response()->json(['error' => 0, 'message' => 'You and '.$userRequest->name.' have been friend ']);
    }
    $friendShip->delete();
    return response()->json(['error' => 0, 'message' => 'Request cancel!']);
  }

  private function isAddYourself() {
    return Auth::user()->id == $this->user;
  }
}
