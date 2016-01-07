<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadImageRequest;

class ImageController extends Controller
{
    public $path = 'upload/images';
    public $publicPath = 'public';

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
        return view('images.index');
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

        if($request->hasFile('image')) {
          $file = $request->file('image');
          $imageName = date('d-m-Y_h-i-s').'_'.$id.'_'.$file->getClientOriginalName();
          $path = $this->path.'/'.$id.'_'.$auth;
          $destination = $path;
          $folder = base_path().'/'.$this->publicPath.'/'.$path;

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
    public function show($id)
    {
        return 'Show an image!';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'Form edit image!';
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
        return 'Request from edit image!';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'Delete image!';
    }
}
