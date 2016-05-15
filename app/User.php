<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

    /**
    * use SoftDeletes
    **/
    protected $dates = ['deleted_at'];

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
    protected $fillable = ['name', 'email', 'password', 'sex', 'address', 'birthday', 'description', 'friends'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email', 'sex', 'birthday', 'created_at', 'updated_at', 'deleted_at'];

    public function album(){
      return $this->hasMany('App\Album', 'user_id');
    }

    public function images() {
      return $this->hasMany('App\Image', 'user_id');
    }

    public function role() {
      return $this->belongsToMany('App\Role', 'user_roles', 'role_id', 'user_id');
    }

    public function hasAnyRole($roles) {
      if(is_array($roles)) {
        foreach($roles as $role) {
          if($this->hasRole($role)) {
            return true;
          }
        }
      }else{
        if($this->hasRole($roles)) {
          return true;
        }
      }
      return false;
    }

    private function hasRole($role) {
      if($this->role()->where('name', $role)->first()) {
        return true;
      }
      return false;
    }

    public function getProfilePictureUrl() {
      $image = $this->images()->where('make_as_profile_picture', 1)->first();
      return is_null($image) ? null : $image->image_url;
    }

    public function getCoverPhotoUrl() {
      $image = $this->images()->where('make_as_cover_photo', 1)->first();
      return is_null($image) ? null : $image->image_url;
    }

    public function friends() {
      return $this->find(json_decode($this->friends));
    }

    public function isAuthor($user) {
      return $user == Auth::user()->id;
    }

    public function isAdmin() {
      return $this->hasAnyRole('admin');
    }
}
