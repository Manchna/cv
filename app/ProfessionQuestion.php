<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionQuestion extends Model
{
    protected $table = 'profession_question';

    protected $fillable = [
        'question_id',
        'profession_id'
    ];
}
