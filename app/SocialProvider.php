<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = [
        'provider_id', 'provider','user_id'
    ];


    function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
