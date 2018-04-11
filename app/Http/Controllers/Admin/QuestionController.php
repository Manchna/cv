<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Profession;
use App\ProfessionQuestion;
use App\Question;

class QuestionController extends Controller
{
    public function create()
    {
        $professions = Profession::get();
        return view('admin/createQuestion')->with(['professions'=>$professions]);
    }


    public function store(QuestionCreateRequest $request)
    {
        $professions = $request->get('professions');

        if(count($professions) == 0 || (count($professions) == 1 && $professions[0] == 'all')) {
            $profData = Profession::select('id')->get();
            $professions = [];
            foreach ($profData as $data) {
                $professions[] = $data->id;
            }
        }

        $questionToAdd['text'] = $request->get('question');
        $question = Question::create($questionToAdd);

        foreach ($professions as $profession) {

            $pivot['question_id']=$question->id;
            $pivot['profession_id']=$profession;
            ProfessionQuestion::insert($pivot);
        }

        return redirect()->route('adminCreateQuestion');
    }


}
