<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['image_name', 'image_title', 'image_url', 'image_size', 'image_caption', 'likes', 'views', 'user_id', 'album_id'];
}
