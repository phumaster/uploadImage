<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model
{
    protected $table = 'friendships';

    protected $fillable = ['from', 'to', 'accepted', 'seen'];

    public $timestamps = false;

    public function getUserSend() {
      return $this->belongsTo('App\User', 'from');
    }

    public function getUserRecieve() {
    	return $this->belongsTo('App\User', 'to');
    }
}
