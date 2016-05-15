<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateCoverPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      $routeParam = isset(Request::route()->user) ? Request::route()->user : null;
      $id = $this->user;
      if($routeParam == $id) {
        return true;
      }
      return redirect()->back();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|image'
        ];
    }
}
