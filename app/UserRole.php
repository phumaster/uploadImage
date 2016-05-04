<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;
    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];

    protected $table = 'user_roles';

    protected $fillable = ['user_id', 'role_id'];
}
