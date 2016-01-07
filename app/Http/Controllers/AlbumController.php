<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAlbumRequest;

class AlbumController extends Controller
{

    public $publicPath = 'public';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = \Auth::user()->id;
        $data['user'] = \Auth::user()->firstName.' '.\Auth::user()->lastName;
        $data['albums'] = \App\User::find($user_id)->album()->get()->toArray();
        return view('albums.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlbumRequest $request)
    {
        $resource['user_id'] = $request->user()->id;
        return \App\Album::create(array_merge($request->except(['_token']), $resource)) ? redirect()->route('album.index')->with(['message' => 'Album created!']) : redirect()->route('album.index')->withErrors('Unexpected error!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = \App\Album::find($id);
        if(count($album) <= 0) {
          return redirect()->route('album.index')->withErrors('No album available.');
        }
        $data['images'] = $album->images()->get();
        return view('albums.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['album'] = \App\Album::find($id);

        if(count($data['album']) <= 0) {
          return redirect()->route('album.index')->withErrors('No album available.');
        }
        return view('albums.edit', $data);
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
        $user_id = \Auth::user()->id;
        if(\App\Album::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update($request->except(['_method', '_token']))) {
          return redirect()->route('album.index')->with(['message' => 'Album has been update.']);
        }
        return redirect()->route('album.edit', $id)->withErrors('Unexpected error!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $album = \App\Album::find($id);
      $is_del = true;
      if(count($album) > 0) {
        $images = \App\Album::find($id)->images()->get()->toArray();

        if(count($images) > 0) {
          foreach($images as $image) {
            if(false == unlink(base_path().'/'.$this->publicPath.'/'.$image['image_url']) || false == \App\Image::destroy($image['id'])) {
              $is_del = false;
              break;
            }
          }
        }

        if($album->delete() && true == $is_del) {
          return redirect()->route('album.index')->with(['message' => 'Album has been delete.']);
        }
      }
      return redirect()->route('album.index')->withErrors('Can not delete album.');
    }
}
