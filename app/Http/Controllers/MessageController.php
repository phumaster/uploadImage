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

      if($request->get('content') != "" && Message::create(['from' => Auth::user()->id, 'to' => $id, 'content' => htmlentities($request->get('content'))])) {
        if(Conversation::where(['from' => Auth::user()->id, 'to' => $id])->orWhere(['to' => Auth::user()->id, 'from' => $id])->get()->count() == 0) {
          Conversation::create(['from' => Auth::user()->id, 'to' => $id]);
        }
        return json_encode(['error' => 0, 'message' => htmlentities($request->get('content')), 'type' => 0]);
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
                  ->paginate(20);
      $data['messages'] = $messages;
      $data['receiver'] = $user;
      return view('messages.show', $data);
    }
}
