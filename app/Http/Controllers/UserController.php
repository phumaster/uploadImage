<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Image;

class UserController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }

    public function index($user, Request $request) {
      $data['user'] = User::find($user);
      $data['profile'] = Image::where(['user_id' => $data['user']->id, 'make_as_profile_picture' => 1])->get()->first();
      $data['cover'] = Image::where(['user_id' => $data['user']->id, 'make_as_cover_photo' => 1])->get()->first();
      if($request->ajax()) {
        return view('user.info', $data);
      }
      return view('user.index', $data);
    }

}
