<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\Message;
use App\Conversation;

class MessageController extends Controller
{
    public function handle(Request $request, $id) {
      $conversation = Conversation::where(['from' => Auth::user()->id, 'to' => $id])->orWhere(['to' => Auth::user()->id, 'from' => $id])->first();
      if(count($conversation) == 0) {
        $conversation = Conversation::create(['from' => Auth::user()->id, 'to' => $id]);
      }
      if($request->get('content') != "" && Message::create(['from' => Auth::user()->id, 'to' => $id, 'content' => htmlentities($request->get('content')), 'conversation_id' => $conversation->id])) {
        $conversation->updated_at = date("Y-m-d H:i:s");
        $conversation->save();
        return json_encode(['error' => 0, 'message' => htmlentities($request->get('content')), 'reciever' => $id, 'avatar_url' => Auth::user()->getProfilePictureUrl(), 'type' => 0]);
      }
      return json_encode(['error' => 1, 'message' => 'Can not send message!', 'type' => -1]);
    }

    public function index() {
      $data['user'] = Auth::user();
      return view('messages.index', $data);
    }

    public function show(Request $request, $user) {
      $messages = Message::where(['from' => Auth::user()->id, 'to' => $user])
                  ->orWhere(['to' => Auth::user()->id, 'from' => $user])->orderBy('id', 'DESC')
                  ->paginate(30);
      $messages = $this->sortMessages($messages);
      $data['messages'] = $messages;
      $data['receiver'] = $user;
      return view('messages.show', $data);
    }

    private function sortMessages($messages) {
      $size = count($messages);
      for($i = 0; $i < $size - 1; $i++) {
        $m = $i;
        for($j = $i+1; $j < $size; $j++) {
          if($messages[$j] < $messages[$m]) {
            $m = $j;
          }
        }
        if($m != $i) {
          $tmp = $messages[$i];
          $messages[$i] = $messages[$m];
          $messages[$m] = $tmp;
        }
      }
      return $messages;
    }
}
