<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class IndexController extends Controller
{
    public function index() {
      if(!Auth::check()) {
        return view('helloworld');
      }
      return redirect()->route('features');
    }
}
