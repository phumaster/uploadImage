<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Message;

class PullRequestController extends Controller
{
    protected $messages = null;
    protected $hasNewMessages = false;

    public function handle(Request $request) {
      $time = time()+10;
      while(1) {
        // check new messages
        if($this->hasNewMessages() || time() >= $time) {
          break;
        }
        continue;
      }
      return response()->json($this->messages);
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
}
