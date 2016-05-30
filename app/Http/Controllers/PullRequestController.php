<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Message;

class PullRequestController extends Controller
{
    protected $messages;
    protected $hasNewMessages = false;

    public function handle(Request $request) {
      $time = time()+50;
      while(1) {
        echo connection_status();
        if($this->hasNewMessages() || time() >= $time) {
          break;
        }
        continue;
      }
      return $this->messages;
    }

    private function hasNewMessages() {
      $messages = Message::where(['id' => Auth::user()->id, 'read' => 0]);
      if($messages->count() <= 0) {
        return false;
      }else{
        $this->messages = $messages->get()->toJson();
        return true;
      }
    }
}
