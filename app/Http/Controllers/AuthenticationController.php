<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

// use models
use App\User;
use App\UserRole;

class AuthenticationController extends Controller
{
    public function __construct() {
      $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function getLogin(){
      return view('login');
    }

    public function postLogin(LoginRequest $request){
      if(Auth::attempt($request->only(['email', 'password']))){
         return $request->ajax() ? json_encode(['error' => 0]) : redirect('/');
      }
      return $request->ajax() ? json_encode(['error' => 1, 'message' => 'The email or password wrong!']) : redirect()->route('login')->withErrors('The email or password wrong!');
    }

    public function getRegister(){
      return view('register');
    }

    public function postRegister(RegisterRequest $request){
      $append = [
        'address' => '',
        'description' => '',
        'password' => bcrypt($request->get('password')),
        'birthday' => '',
        'sex' => ''
      ];
      if($user = User::create(array_merge($request->except(['_token', 'confPassword', 'password']), $append))){
        $user->role()->attach($user->id, ['role_id' => 3]);
        return $request->ajax() ? json_encode(['error' => 0, 'forceLogin' => 1, 'message' => 'Create account success. Please login now!']) : redirect()->route('login')->with(['message' => 'Create account success. Please login now!']);
      }
      return $request->ajax() ? json_encode(['error' => 1, 'message' => 'unexpected error!']) : redirect()->route('register')->withErrors('Unexpected error!');
    }

    public function getLogout(){
      Auth::logout();
      return redirect('/');
    }
}
