<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        if ($this->role==1){
            return true;
        }
        else{
            return false;
        }
        // this looks for an admin column in your users table
    }

    function socialProviders(){
        return $this->hasMany('App\SocialProvider');
    }
    function answer(){
        return $this->hasMany('App\Answer');
    }

}
