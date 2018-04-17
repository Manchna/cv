<?php
namespace App\Repositories\Admin\Question;

interface QuestionInterface {

    public function get();

    public function create($data);
}