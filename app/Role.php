<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];

    protected $table = 'roles';
    
    protected $fillable = ['name', 'description', 'slug'];

    public function user() {
      return $this->belongsToMany('App\User', 'user_roles', 'user_id', 'role_id');
    }
}
