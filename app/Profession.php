<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = [
        'name',
    ];


    function question(){
        return $this->belongsToMany('App\Question', 'profession_question',
            'profession_id', 'question_id');
    }
}
