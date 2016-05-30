<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];

    protected $table = 'images';

    protected $fillable = ['id', 'image_name', 'fullsize_url', 'image_size', 'image_caption', 'likes', 'views', 'user_id', 'album_id', 'make_as_cover_photo', 'make_as_profile_picture'];

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function album() {
      return $this->belongsTo('App\Album', 'album_id');
    }

    public function comments() {
      return $this->hasMany('App\Comment_image', 'image_id');
    }
}
