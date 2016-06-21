<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = ['from', 'to', 'content', 'read', 'seen', 'attachment_url', 'conversation_id'];

    protected $hidden = ['seen'];

    public function user() {
      return $this->belongsTo('App\User', 'from');
    }

    public function conversation() {
    	return $this->belongsTo('App\Conversation', 'conversation_id');
    }
}
