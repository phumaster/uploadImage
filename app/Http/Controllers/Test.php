<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Test extends Controller
{
    public function test(Request $request) {
      dd($request->user()->friends());
      //dd($request->user()->hasAnyRole('author'));
    }
}