<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'text', 'user_id','question_id'
    ];

    public function getOneAnswer($id)
    {
        return static::where('user_id', $id)->get();
    }

    public function getOneForUpdateAnswer($userId, $questionId)
    {
        return static::where('user_id', $userId)->where('question_id', $questionId)->get();
    }

    public function insertAnswer(array $data)
    {
        return static::insert($data);
    }


    public function updateAnswer(array $data, $userId, $questionId)
    {

        return static::where('user_id', $userId)->where('question_id', $questionId)->update($data);
    }



    function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    function question(){
        return $this->belongsTo('App\Question', 'question_id');
    }
}
