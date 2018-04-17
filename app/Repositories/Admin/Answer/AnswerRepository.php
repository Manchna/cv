<?php
/**
 * Created by PhpStorm.
 * User: manch
 * Date: 16-Apr-18
 * Time: 17:32
 */

namespace App\Repositories\Admin\Answer;


use App\Answer;

class AnswerRepository  implements AnswerInterface
{
    private $answer;


    function __construct(Answer $answer) {
        $this->answer = $answer;
    }

    public function getOne($id)
    {
        return $this->answer->getOneAnswer($id);
    }
    public function getOneForUpdate($userId ,$questionId)
    {
        return $this->answer->getOneForUpdateAnswer($userId ,$questionId);
    }

    public function insert(array $data)
    {
        return $this->answer->insertAnswer($data);
    }

    public function update(array $data, $userId, $questionId)
    {
        return $this->answer->updateAnswer($data, $userId, $questionId);
    }
}