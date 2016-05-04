<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Comment_image extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];
    
    protected $table = 'comment_images';

    protected $fillable = ['comment_content', 'likes', 'comment_status', 'user_id', 'image_id'];

    public function user() {
      return $this->belongsTo('App\User', 'user_id');
    }

    public function image() {
      return $this->belongsTo('App\Image', 'image_id');
    }
}
