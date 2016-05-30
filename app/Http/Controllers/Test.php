<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Helpers\ImageHelper;

class Test extends Controller
{
    public function test(Request $request) {
      // $strTime = '2016-05-15 17:21:02';
      // $time = strtotime($strTime);
      // echo date("d/m/Y - H:i:s" ,$time);

      $info = public_path().'/upload/images/1_phumaster.dev@gmail.com/avatar/30-05-2016_08-18-32_1_c0158a5d0afdbb8b3d177162b9328a7c_1452770729.jpg';
      // dd($info);
      // ImageHelper::load($info)->resize(50, 50)->save(public_path().'/abc.jpg');
      echo 'ok';
    }
}
