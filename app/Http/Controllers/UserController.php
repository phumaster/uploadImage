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
      if($request->ajax()) {
        return view('user.info', $data);
      }
      return view('user.index', $data);
    }

}
