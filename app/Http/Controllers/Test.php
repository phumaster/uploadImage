<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Test extends Controller
{
    public function test(Request $request) {
      $strTime = '2016-05-15 17:21:02';
      $time = strtotime($strTime);
      echo date("d/m/Y - H:i:s" ,$time);
    }
}
