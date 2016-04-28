<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthenticationController extends Controller
{
    public function __construct() {
      $this->middleware('guest', ['except' => 'getLogout']);
    }
    public function getLogin(){
      return view('login');
    }

    public function postLogin(LoginRequest $request){
      return Auth::attempt($request->only(['email', 'password'])) ? redirect('/') : redirect()->route('login')->withErrors('The email or password wrong!');
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
      if(\App\User::create(array_merge($request->except(['_token', 'confPassword', 'password']), $append))){
        return redirect()->route('login')->with(['message' => 'Create account success. Please login now!']);
      }
      return redirect()->route('register')->withErrors('Unexpected error!');
    }

    public function getLogout(){
      return Auth::logout() ? redirect('/') : redirect('/');
    }
}
