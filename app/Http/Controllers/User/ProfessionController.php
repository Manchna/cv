<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfessionRequest;
use App\Repositories\User\Profession\ProfessionInterface;

class ProfessionController extends Controller
{

    private $professionRepo;

    public function __construct(ProfessionInterface $professionRepo)
    {
        $this->professionRepo = $professionRepo;
    }
    public function create(UserProfessionRequest $request)
    {
        $professionId = $request->get('profession');
        $profession = $this->professionRepo->find($professionId);
        $data['professionId'] = $professionId;
        $data['questions'] = $profession->question;

        return view('user/cv')->with(['data' => $data]);
    }

}
