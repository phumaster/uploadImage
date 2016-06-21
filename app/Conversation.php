<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $fillable = ['from', 'to'];

    public function user() {
      return $this->belongsTo('App\User', 'from');
    }

    public function sendToUser() {
      return $this->belongsTo('App\User', 'to');
    }

    public function messages() {
    	return $this->hasMany('App\Message', 'conversation_id');
    }

    public function getLastMessage() {
    	return $this->hasMany('App\Message', 'conversation_id')->orderBy('id', 'DESC');
    }
}
