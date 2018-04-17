<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAnswerRequest;
use App\Repositories\Admin\Answer\AnswerInterface as AnswerInterface;
use Carbon\Carbon;

class AnswerController extends Controller
{
    private $answerRepo;

    public function __construct(AnswerInterface $answerRepo)
    {
        $this->answerRepo = $answerRepo;
    }

    public function update(UserAnswerRequest $request, $id)
    {
        $answers = $request->get('answer');
        $userId=$id;
        $now = Carbon::now();
        $data = [];
        foreach ($answers as $key => $answer) {
            $data['text'] = $answer;
            $data['updated_at'] = $now;
            $this->answerRepo->getOneForUpdate($userId, $key);
            $this->answerRepo->update($data, $userId, $key);
        }
        return redirect()->route('adminUser',['id'=>$userId]);
    }
}
