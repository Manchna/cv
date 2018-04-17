<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionCreateRequest;
use App\Repositories\Admin\Profession\ProfessionInterface as ProfessionInterface;
use App\Repositories\Admin\ProfessionQuestion\ProfessionQuestionInterface as ProfessionQuestionInterface;
use App\Repositories\Admin\Question\QuestionInterface as QuestionInterface;

class QuestionController extends Controller
{
    private $questionRepo;
    private $professionRepo;
    private $professionQuestion;


    public function __construct(QuestionInterface $questionRepo, ProfessionInterface  $professionRepo, ProfessionQuestionInterface  $professionQuestion)
    {
        $this->questionRepo = $questionRepo;
        $this->professionRepo = $professionRepo;
        $this->professionQuestion = $professionQuestion;
    }


    public function create()
    {
        $professions = $this->professionRepo->getAll();
        return view('admin/createQuestion')->with(['professions'=>$professions]);
    }


    public function store(QuestionCreateRequest $request)
    {
        $professions = $request->get('professions');

        if(count($professions) == 0 || (count($professions) == 1 && $professions[0] == 'all')) {
            $profData = $this->professionRepo->select('id');
            $professions = [];
            foreach ($profData as $data) {
                $professions[] = $data->id;
            }
        }

        $questionToAdd['text'] = $request->get('question');
        $question = $this->questionRepo->create($questionToAdd);

        foreach ($professions as $profession) {

            $pivot['question_id']=$question->id;
            $pivot['profession_id']=$profession;
            $this->professionQuestion->insert($pivot);
        }

        return redirect()->route('adminCreateQuestion');
    }


}
