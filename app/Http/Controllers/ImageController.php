<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;

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
    public function index()
    {
        $data['images'] = \App\Image::paginate(10);
        return view('images.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $albums = \App\User::find(\Auth::user()->id)->album()->get()->toArray();
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
    public function store(UploadImageRequest $request)
    {
        $id = \Auth::user()->id;
        $auth = \Auth::user()->email;
        $resource = $request->except(['_token', 'image']);

        //dd($request->file('image'));

        if(!$request->get('album_id')) {
          $data_album = [
            'album_name' => 'Untitled',
            'album_title' => 'Untitled album',
            'album_description' => '',
            'user_id' => $id
          ];

          if(!$album = \App\Album::create($data_album)) {
            return redirect()->route('image.create')->withErrors('Unexpected error!');
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
            'image_url' => $path.'/'.$imageName
          ];

          if($file->move($destination, $imageName) && \App\Image::create(array_merge($resource, $image))) {
            return redirect()->route('image.index')->with(['message' => 'Your image has been upload!']);
          }

        }
        return redirect()->route('image.create')->withErrors('Unexpected error!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $id)
    {
        $image = \App\Image::where(['id' => $id, 'user_id' => $user])->get()->first();

        if(count($image) <= 0) {
          return redirect()->route('image.index')->withErrors('No image to show.');
        }

        $user_data = \App\Image::find($id)->user()->get()->first();
        $album = \App\Image::find($id)->album()->get()->first();
        $comments = \App\Image::find($id)->comments()->get();

        $data['image'] = $image;
        $data['user'] = $user_data;
        $data['album'] = $album;
        $data['comments'] = $comments;

        return view('images.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['image'] = \App\Image::find($id);
        $albums = \App\User::find(\Auth::user()->id)->album()->get()->toArray();
        foreach ($albums as $key => $value) {
          $data['albums'][$value['id']] = $value['album_name'];
        }

        if(count($data['image']) <= 0) {
          return redirect()->route('image.index')->withErrors('Image does not exists.');
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
    public function update(Request $request, $id)
    {
      $data = \App\Image::find($id);
      $user_id = \Auth::user()->id;
      $auth = \Auth::user()->email;
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
          'image_url' => $path.'/'.$imageName
        ];


        if(unlink(public_path().'/'.$data->image_url) && $file->move($destination, $imageName) && \App\Image::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update(array_merge($resource, $image))) {
          return redirect()->route('image.index')->with(['message' => 'Your image has been update!']);
        }

      }

      if(\App\Image::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update($resource)) {
        return redirect()->route('image.index')->with(['message' => 'Your image has been update!']);
      }
      return redirect()->route('image.edit', $id)->withErrors('Unexpected error!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = \App\Image::find($id);
        if(count($image) > 0) {
          if($image->delete() && unlink(public_path().'/'.$image->image_url)) {
            return redirect()->route('image.index')->with(['message' => 'The image has been delete.']);
          }
        }
        return redirect()->route('image.index')->withErrors('The image does not exists.');
    }
}
