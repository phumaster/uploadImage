<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\User;

class AddInfoController extends Controller
{
    public function add(Request $request, $user) {
      $u = User::find($user);
      if($u->update(['sex' => $request->get('sex'), 'address' => $request->get('address'), 'skip_add_info' => 1])) {
        return redirect()->route('index');
      }
      return redirect()->route('index')->withErrors('Can not update your information');
    }
}
