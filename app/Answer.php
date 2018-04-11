<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'text', 'user_id','question_id'
    ];

    function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    function question(){
        return $this->belongsTo('App\Question', 'question_id');
    }
}
