<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Model implements AuthenticatableContract,CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','profiles_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Models\Profile');
    }

    public function status(){
        return $this->hasMany('App\Models\Status');
    }

    public function loves(){
        return $this->hasMany('App\Models\Love');
    }

    public function votes(){
        return $this->hasMany('App\Models\Vote');
    }

    public function notifications(){
        return $this->hasMany('App\Models\Notification');
    }

    public function followers(){
        return $this->hasMany('App\Models\Following','leader');
    }

    public function leaders(){
        return $this->hasMany('App\Models\Following','follower');
    }

    public function interestedIn(){
        return $this->hasMany('App\Models\Interest','shower');
    }

    public function InTheirInterest(){
        return $this->hasMany('App\Models\Interest','subject');
    }


}
