<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index($user, Request $request) {
      $data['user'] = \App\User::find($user);
      $data['profile'] = \App\Image::where(['user_id' => $data['user']->id, 'make_as_profile_picture' => 1])->get()->first();
      $data['cover'] = \App\Image::where(['user_id' => $data['user']->id, 'make_as_cover_photo' => 1])->get()->first();
      if($request->ajax()) {
        return view('user.info', $data);
      }
      return view('user.index', $data);
    }

}
