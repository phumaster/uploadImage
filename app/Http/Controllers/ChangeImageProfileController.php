<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests
use App\Http\Requests\UpdateProfilePictureRequest;
use App\Http\Requests\UpdateCoverPhotoRequest;

// use models
use App\User;
use App\Album;
use App\Image;

class ChangeImageProfileController extends Controller
{
    private $user;

    public function __construct(Request $request) {
      $this->middleware('auth');
      $this->user = User::find($request->user()->id);
    }

    public function changeProfilePicture($user, UpdateProfilePictureRequest $request) {
      if($request->hasFile('image')) {
        $file = $request->file('image');
        $album = Album::where('album_name', 'Profile picture')->get()->first();
        if(count($album)) {
          $albumId = $album->id;
        }else{
          if($newAlbum = Album::create([
            'album_name' => 'Profile picture',
            'album_title' => 'Profile picture',
            'album_description' => '',
            'user_id' => $this->user->id
          ])) {
            $albumId = $newAlbum->id;
          }else{
            return response('Unexpected error!', 422);
          }
        }
        $destination = public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email.'/avatar';
        if(!file_exists(public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email)) {
          mkdir(public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email);
        }
        if(!file_exists($destination)) {
          mkdir($destination);
        }
        $imageName = date('d-m-Y_h-i-s').'_'.$this->user->id.'_'.$file->getClientOriginalName();
        $imageUrl = 'upload/images/'.$this->user->id.'_'.$this->user->email.'/avatar/'.$imageName;
        $imageArr = [
          'image_name' => $imageName,
          'image_url' => $imageUrl,
          'image_size' => $file->getSize(),
          'image_caption' => '',
          'user_id' => $this->user->id,
          'album_id' => $albumId,
          'make_as_profile_picture' => 1
        ];
        $changeImage = Image::find($this->hasProfilePicture($this->user->id));
        if(!is_null($changeImage)) {
          $changeImage->make_as_profile_picture = 0;
          $changeImage->save();
        }
        if($file->move($destination, $imageName) && Image::create($imageArr)) {
          $data['errors'] = 0;
          $data['msg'] = 'Your profile picture has been change!';
          $data['imageUrl'] = url($imageUrl);
          return json_encode($data);
        }
        return response('Unexpected error while changging your profile picture!', 422);
      }
    }

    public function changeCoverPhoto($user, UpdateCoverPhotoRequest $request) {
      if($request->hasFile('image')) {
        $file = $request->file('image');
        $album = Album::where('album_name', 'Cover photos')->get()->first();
        if(count($album)) {
          $albumId = $album->id;
        }else{
          if($newAlbum = Album::create([
            'album_name' => 'Cover photos',
            'album_title' => 'Cover photos',
            'album_description' => '',
            'user_id' => $this->user->id
          ])) {
            $albumId = $newAlbum->id;
          }else{
            return response('Unexpected error!', 422);
          }
        }
        $destination = public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email.'/cover';
        if(!file_exists(public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email)) {
          mkdir(public_path().'/upload/images/'.$this->user->id.'_'.$this->user->email);
        }
        if(!file_exists($destination)) {
          mkdir($destination);
        }
        $imageName = date('d-m-Y_h-i-s').'_'.$this->user->id.'_'.$file->getClientOriginalName();
        $imageUrl = 'upload/images/'.$this->user->id.'_'.$this->user->email.'/cover/'.$imageName;
        $imageArr = [
          'image_name' => $imageName,
          'image_url' => $imageUrl,
          'image_size' => $file->getSize(),
          'image_caption' => '',
          'user_id' => $this->user->id,
          'album_id' => $albumId,
          'make_as_cover_photo' => 1
        ];
        $changeImage = Image::find($this->hasCoverPhoto($this->user->id));
        if(!is_null($changeImage)) {
          $changeImage->make_as_cover_photo = 0;
          $changeImage->save();
        }
        if($file->move($destination, $imageName) && Image::create($imageArr)) {
          $data['errors'] = 0;
          $data['msg'] = 'Your cover photo has been change!';
          $data['imageUrl'] = url($imageUrl);
          return json_encode($data);
        }
        return response('Unexpected error while changging your cover photo!', 422);
      }
    }

    private function hasProfilePicture($user_id) {
      $need = Image::where(['user_id' => $user_id, 'make_as_profile_picture' => 1])->get()->first();
      return ($need) ? $need->id : null;
    }

    private function hasCoverPhoto($user_id) {
      $need = Image::where(['user_id' => $user_id, 'make_as_cover_photo' => 1])->get()->first();
      return ($need) ? $need->id : null;
    }
}
