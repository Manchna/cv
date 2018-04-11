<?php

namespace App\Http\Controllers\User;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAnswerRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

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

        Answer::insert($data);

        return redirect()->route('home');
    }

    public function update(UserAnswerRequest $request)
    {
        $answers = $request->get('answer');
        $userId = Auth::user()->id;
        $now = Carbon::now();


        foreach ($answers as $key => $answer) {

            Answer::where('user_id', $userId)->where('question_id', $key)->update([
                'text' => $answer,
                'updated_at' => $now
            ]);
        }

        return redirect()->route('home');
    }
}
