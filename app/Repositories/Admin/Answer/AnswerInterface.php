<?php
namespace App\Repositories\Admin\Answer;

interface AnswerInterface {

    public function getOne($id);

    public function getOneForUpdate($userId, $questionId);

    public function insert(array $data);

    public function update(array $data, $userId, $questionId);

}