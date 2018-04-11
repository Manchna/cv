<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text', 'profession_id',
    ];

    function profession(){
        return $this->belongsToMany('App\Profession', 'profession_question',
            'question_id', 'profession_id');
    }

    function answer(){
        return $this->hasMany('App\Answer');
    }


}
