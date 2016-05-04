<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment_album extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];
    
    protected $table = 'comment_albums';

    protected $fillable = ['comment_content', 'comment_status', 'likes', 'user_id', 'album_id'];

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function album() {
      return $this->belongsTo('App\Album', 'album_id');
    }
}
