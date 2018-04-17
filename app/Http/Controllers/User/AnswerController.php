<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAnswerRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\User\Answer\AnswerInterface as AnswerInterface ;


class AnswerController extends Controller
{
    private $answerRepo;

    public function __construct(AnswerInterface $answerRepo)
    {
        $this->answerRepo = $answerRepo;
    }
    public function store(UserAnswerRequest $request)
    {

        $userId = Auth::user()->id;
        $answers = $request->get('answer');
        $data = [];
        $now = Carbon::now();

        foreach ($answers as $key => $answer) {
            $data[] = [
                'text' => $answer,
                'user_id' => $userId,
                'question_id' => $key,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }
        $this->answerRepo->insert($data);
        return redirect()->route('home');
    }

    public function update(UserAnswerRequest $request)
    {
        $answers = $request->get('answer');
        $userId=Auth::user()->id;
        $now = Carbon::now();
        $data = [];
        foreach ($answers as $key => $answer) {
            $data['text'] = $answer;
            $data['updated_at'] = $now;
            $this->answerRepo->getOneForUpdate($userId, $key);
            $this->answerRepo->update($data, $userId, $key);
        }
        return redirect()->route('home');
    }
}
