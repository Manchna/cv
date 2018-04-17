<?php


namespace App\Repositories\Admin\Question;


use App\Question;

class QuestionRepository implements QuestionInterface
{
    private $question;

    function __construct(Question $question) {
        $this->question = $question;
    }

    public function get()
    {
        return $this->question->getQuestion();
    }
    public function create($data)
    {
        return $this->question->createQuestion($data);
    }
}