<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Message;
use App\FriendShip;

class PullRequestController extends Controller
{
    protected $messages = null;
    protected $friendRequest = null;

    public function handle(Request $request) {
      $time = time()+10;
      while(1) {
        if($this->hasNewMessages() || $this->hasFriendRequest() || time() >= $time) {
          break;
        }
        continue;
      }
      return response()->json([
        'messages' => $this->messages,
        'friendRequest' => $this->friendRequest
      ]);
    }

    private function hasNewMessages() {
      $messages = Message::where(['to' => Auth::user()->id, 'read' => 0])->get();
      if($messages->count() <= 0) {
        return false;
      }else{
        foreach($messages as $message) {
          $message->update(['read' => 1]);
          $u = $message->user()->first();
          $avatar = $u->getProfilePictureUrl();
          $data[] = array_merge($message->toArray(), ['user' => $u->toArray(), 'xhr' => route('message', $u['id']), 'avatar_url' => $avatar]);
        }
        $this->messages = $data;
        return true;
      }
    }

    private function hasFriendRequest() {
      $requests = FriendShip::where(['to' => Auth::user()->id, 'accepted' => 0, 'seen' => 0])->get();
      if($requests->count() <= 0) {
        return false;
      }else{
        foreach($requests as $request) {
          $request->update(['seen' => 1]);
          $user = $request->getUserSend()->first();
          $data[] = array_merge($request->toArray(), ['user' => $user->toArray(), 'xhr' => route('accept-request', $user->id), 'avatar_url' => $user->getProfilePictureUrl()]);
        }
        $this->friendRequest = $data;
        return true;
      }
    }
}
