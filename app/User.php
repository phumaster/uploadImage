<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Auth;

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
    protected $fillable = ['name', 'email', 'password', 'sex', 'address', 'birthday', 'description', 'friends', 'skip_add_info'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'email', 'sex', 'birthday', 'skip_add_info','friends','created_at', 'updated_at', 'deleted_at'];

    public function messagesSent() {
      return $this->hasMany('App\Message', 'from');
    }

    public function messagesReceived() {
      return $this->hasMany('App\Message', 'to');
    }

    public function newMessage() {
      return $this->hasMany('App\Message', 'to')->where('read', 0);
    }

    public function conversations() {
      return $this->hasMany('App\Conversation', 'from')->orderBy('updated_at', 'DESC');
    }

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
      return is_null($image) ? "images/logo.png" : $image->fullsize_url;
    }

    public function getCoverPhotoUrl() {
      $image = $this->images()->where('make_as_cover_photo', 1)->first();
      return is_null($image) ? null : $image->fullsize_url;
    }

    public function friends() {
      return $this->find(json_decode($this->friends));
    }

    public function isFriend($user) {
      $friends = array_keys(json_decode(Auth::user()->friends, true));
      if(in_array($user, $friends)) {
        return true;
      }
      return false;
    }

    public function isAuthor($user) {
      return $user == Auth::user()->id;
    }

    public function isAdmin() {
      return $this->hasAnyRole('admin');
    }

    public function hasFriendRequest() {
      return $this->hasMany('App\FriendShip', 'to');
    }

    public function requestSent() {
      return $this->hasMany('App\FriendShip', 'from');
    }

    public function isSentRequest($user) {
      $allFriendRequest = $this->hasFriendRequest()->get();
      $requestSent = $this->requestSent()->get();

      if($allFriendRequest->count() == 0 && $requestSent->count() == 0) {
        return false;
      }else{
        foreach($allFriendRequest as $k) {
          if($k['from'] == $user && $k['accepted'] == 0) {
            return true;
          }
        }
        foreach($requestSent as $k) {
          if($user == $k['to'] && $k['accepted'] == 0) {
            return true;
          }
        }
        return false;
      }
    }
}
