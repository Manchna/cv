<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAnswerRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    public function update(UserAnswerRequest $request, $id)
    {
        $answers = $request->get('answer');
        $userId = $id;
        $now = Carbon::now();

        foreach ($answers as $key => $answer) {

            Answer::where('user_id', $userId)->where('question_id', $key)->update([
                'text' => $answer,
                'updated_at' => $now
            ]);
        }
        return redirect()->route('adminUser',['id'=>$userId]);
    }
}
