<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';

    protected $fillable = ['album_name', 'album_title', 'album_description', 'likes', 'views', 'user_id'];

    public function user(){
      return $this->belongsTo('App\User', 'user_id');
    }

    public function images() {
      return $this->hasMany('App\Image', 'album_id');
    }

    public function comments() {
      return $this->hasMany('App\Comment_album', 'album_id');
    }
}
