<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAlbumRequest;

class AlbumController extends Controller
{

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
        $user_data = \App\User::find($user);
        $alb = $user_data->album()->get()->toArray();
        foreach ($alb as $album) {
          $images['images'] = \App\Album::find($album['id'])->images()->get()->toArray();
          $albums[] = array_merge($album, $images);
        }

        $albums = count($alb) > 0 ? $albums : null;
        $data['user'] = $user_data;
        $data['albums'] = $albums;

        if($request->ajax()) {
          return json_encode($data);
        }

        return view('albums.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user)
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateAlbumRequest $request, $user)
    {
        $resource['user_id'] = $user;
        return \App\Album::create(array_merge($request->except(['_token']), $resource)) ? redirect()->route('album.index', $user)->with(['message' => 'Album created!']) : redirect()->route('album.index', $user)->withErrors('Unexpected error!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user ,$id)
    {
        $album = \App\Album::where(['id' => $id, 'user_id' => $user])->get()->first();
        if(count($album) <= 0) {
          return redirect()->route('album.index', $user)->withErrors('No album available.');
        }
        $data['comments'] = $album->comments()->get();
        $data['images'] = $album->images()->paginate(50);
        $data['album'] = $album;
        return view('albums.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user, $id)
    {
        $data['album'] = \App\Album::where(['id' => $id, 'user_id' => $user])->get()->first();

        if(count($data['album']) <= 0) {
          return redirect()->route('album.index', $user)->withErrors('No album available.');
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
    public function update(Request $request, $user, $id)
    {
        $user_id = \Auth::user()->id;
        if(\App\Album::whereRaw("`id` = {$id} AND `user_id` = {$user_id}")->update($request->except(['_method', '_token']))) {
          return redirect()->route('album.index', $user)->with(['message' => 'Album has been update.']);
        }
        return redirect()->route('album.edit', [$user, $id])->withErrors('Unexpected error!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user, $id)
    {
      $album = \App\Album::where(['id' => $id, 'user_id' => $user]);
      $is_del = true;
      if(count($album->get()->toArray())) {
        $images = \App\Album::find($id);
        if(count($images) > 0) {
          $images = $images->images()->get()->toArray();
          foreach($images as $image) {
            $comment_img = \App\Comment_image::where('image_id', $image['id']);
            if(count($comment_img->get()->toArray())) {
              if(false == $comment_img->delete()) {
                $is_del = false;
              }
            }
            if(false == unlink(public_path().'/'.$image['image_url']) || false == \App\Image::destroy($image['id'])) {
              $is_del = false;
              break;
            }
          }
        }
        $album_id = $album->get()->first()->id;
        $comment = \App\Comment_album::where('album_id', $album_id);

        if(count($comment->get()->toArray())) {
          if(false == $comment->delete()) {
            $is_del = false;
          }
        }
        if($album->delete() && true == $is_del) {
          return redirect()->route('album.index', $user)->with(['message' => 'Album has been delete.']);
        }
      }
      return redirect()->route('album.index', $user)->withErrors('Can not delete album.');
    }
}
