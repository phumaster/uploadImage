<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_album extends Model
{
    protected $table = 'comment_albums';

    protected $fillable = ['comment_content', 'comment_status', 'likes', 'user_id', 'album_id'];

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function album() {
      return $this->belongsTo('App\Album', 'album_id');
    }
}
