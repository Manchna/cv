<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfessionRequest;
use App\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{

    public function create(UserProfessionRequest $request)
    {
        $professionId = $request->get('profession');
        $profession = Profession::find($professionId);

        $data['professionId'] = $professionId;
        $data['questions'] = $profession->question;

        return view('user/cv')->with(['data' => $data]);
    }

}
