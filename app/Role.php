<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = ['name', 'description', 'slug'];

    public function user() {
      return $this->belongsToMany('App\User', 'user_roles', 'user_id', 'role_id');
    }
}
