<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// use requests0
use App\Http\Requests\UploadImageRequest;

// use models
use Auth;
use App\User;
use App\Image;
use App\Album;
use App\Comment_image;

class ImageController extends Controller
{
    public $path = 'upload/images';

    public function __construct() {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user, Request $request)
    {
        $data['images'] = Image::where('user_id', $user)->paginate(10);
        return view('images.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user)
    {
        $albums = User::find(\Auth::user()->id)->album()->get()->toArray();
        foreach ($albums as $key => $value) {
          $data['albums'][$value['id']] = $value['album_name'];
        }

        $data['albums'] = count($albums) > 0 ? $data['albums'] : null;
        return view('images.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request, $user)
    {
        if(!file_exists(public_path().'/upload')) {
          mkdir(public_path().'/upload');
        }
        if(!file_exists(public_path().'/upload/images/')) {
          mkdir(public_path().'/upload/images');
        }

        $id = Auth::user()->id;
        $auth = substr(md5(Auth::user()->name), 0, 10);
        $resource = $request->except(['_token', 'image']);

        //dd($request->file('image'));

        if(!$request->get('album_id')) {
          $data_album = [
            'album_name' => 'Untitled',
            'album_title' => 'Untitled album',
            'user_id' => $id
          ];

          if(!$album = Album::create($data_album)) {
            return redirect()->route('photo.create', $user)->withErrors('Unexpected error!');
          }

          $resource['album_id'] = $album->id;
        }

        if($request->hasFile('image')) {
          $file = $request->file('image');
          $imageName = date('d-m-Y_h-i-s').'_'.$id.'_'.$file->getClientOriginalName();
          $path = $this->path.'/'.$id.'_'.$auth;
          $destination = $path;
          $folder = public_path().'/'.$path;

          if(!file_exists($folder)) {
            mkdir($folder);
          }

          $image = [
            'image_name' => $imageName,
            'image_size' => $file->getSize(),
            'user_id' => $id,
            'fullsize_url' => $path.'/'.$imageName
          ];

          if($file->move($destination, $imageName) && Image::create(array_merge($resource, $image))) {
            return response()->json(['message' => 'Your photo has been upload!']);
          }

        }
        return response()->json(['message' => 'Unexpected errors']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $id)
    {
        $image = Image::where(['id' => $id, 'user_id' => $user])->first();

        if(count($image) <= 0) {
          return redirect()->route('photo.index', $user)->withErrors('The photo doesn\'t exists!');
        }

        $data['image'] = $image;

        return view('images.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $id)
    {
        $data['image'] = Image::find($id);
        $albums = User::find(Auth::user()->id)->album()->get()->toArray();
        foreach ($albums as $key => $value) {
          $data['albums'][$value['id']] = $value['album_name'];
        }

        if(count($data['image']) <= 0) {
          return redirect()->route('photo.index', $user)->withErrors('Image does not exists.');
        }
        return view('images.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $id)
    {
      $a = Auth::user();
      $data = Image::find($id);
      $user_id = $a->id;
      $auth = substr(md5($a->name), 0, 10);
      $resource = $request->except(['_token', 'image', '_method']);

      if($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = date('d-m-Y_h-i-s').'_'.$user_id.'_'.$file->getClientOriginalName();
        $path = $this->path.'/'.$user_id.'_'.$auth;
        $destination = $path;
        $folder = public_path().'/'.$path;

        if(!file_exists($folder)) {
          mkdir($folder);
        }

        $image = [
          'image_name' => $imageName,
          'image_size' => $file->getSize(),
          'fullsize_url' => $path.'/'.$imageName
        ];


        if(unlink(public_path().'/'.$data->fullsize_url) && $file->move($destination, $imageName) && Image::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update(array_merge($resource, $image))) {
          return redirect()->route('photo.index', $user)->with(['message' => 'Your image has been update!']);
        }

      }

      if(Image::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update($resource)) {
        return redirect()->route('photo.index', $user)->with(['message' => 'Your image has been update!']);
      }
      return redirect()->route('photo.edit', [$user, $id])->withErrors('Unexpected error!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $id)
    {
        $image = Image::where(['id' => $id, 'user_id' => $user]);
        if(count($image->get()->toArray()) > 0) {
          if(count(Comment_image::find($id)) > 0){
            Comment_image::where('image_id', $id)->delete();
          }
          if(unlink(public_path().'/'.$image->get()->first()->fullsize_url) && $image->delete()) {
            return redirect()->route('photo.index', $user)->with(['message' => 'The image has been delete.']);
          }
        }
        return redirect()->route('photo.index', $user)->withErrors('The image does not exists.');
    }
}
