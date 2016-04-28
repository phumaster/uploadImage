<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'sex', 'address', 'birthday', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email', 'sex', 'birthday', 'created_at', 'updated_at'];

    public function album(){
      return $this->hasMany('App\Album', 'user_id');
    }

    public function images() {
      return $this->hasMany('App\Image', 'user_id');
    }

    public function role() {
      return $this->belongsToMany('App\Role', 'user_roles', 'role_id', 'user_id');
    }

    public function hasAnyRole($role) {
      if(null == $role) {
        return false;
      }
      if($this->hasRole($role)) {
        return true;
      }
      return false;
    }

    private function hasRole($role) {
      if($this->role()->where('name', $role)->first()) {
        return true;
      }
      return false;
    }
}
