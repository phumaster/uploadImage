<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];
    
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
