<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model
{
    protected $table = 'friendships';

    protected $fillable = ['from', 'to', 'accepted', 'seen'];

    public $timestamps = false;

    public function user() {
      return $this->belongsTo('App\User', 'to');
    }
}
