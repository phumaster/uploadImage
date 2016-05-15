<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class FeaturesController extends Controller
{
    public function index() {
      $data['user'] = Auth::user();
      return view('features', $data);
    }
}
