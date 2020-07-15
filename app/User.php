<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, Followable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','avatar','password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'username';
    }
    public function setPasswordAttribute($value){

        $this->attributes['password']= bcrypt($value);
    }

    public function tweets(){
        return $this->hasMany('App\Tweet');
    }
    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function profilePath(){
        return route('profile.show',$this->username);
    }

    public function getAvatar($avatar){
        return $avatar ? asset('storage/'.$avatar): 'https://i.pravatar.cc/150?u='.$this->id/*asset('images/default.png')*/;
    }

}
