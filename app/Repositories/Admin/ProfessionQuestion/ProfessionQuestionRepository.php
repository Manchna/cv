<?php

namespace App\Repositories\Admin\ProfessionQuestion;


use App\ProfessionQuestion;

class ProfessionQuestionRepository implements ProfessionQuestionInterface
{
    private $professionQuestion;

    function __construct(ProfessionQuestion $professionQuestion) {
        $this->professionQuestion = $professionQuestion;
    }
    public function insert($data)
    {
        return $this->professionQuestion->insertProfessionQuestion($data);
    }
}