<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = [
        'name',
    ];

    public function getAllProfession(){
        return static::get();
    }
    public function findProfession($id){
        return static::find($id);
    }
    public function selectProfession($id){
        return static::select($id)->get();
    }
    public function createProfession($data){
        return static::create($data);
    }

    function question(){
        return $this->belongsToMany('App\Question', 'profession_question',
            'profession_id', 'question_id');
    }
}
