<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_image extends Model
{
    protected $table = 'comment_images';

    protected $fillable = ['comment_content', 'likes', 'comment_status', 'user_id', 'image_id'];

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function image() {
      return $this->belongsTo('App\Image', 'image_id');
    }
}
