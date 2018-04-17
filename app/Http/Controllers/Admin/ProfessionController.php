<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionCreateRequest;
use App\Repositories\Admin\Profession\ProfessionInterface as ProfessionInterface;


class ProfessionController extends Controller
{
    private $professionRepo;


    public function __construct(ProfessionInterface $professionRepo)
    {
        $this->professionRepo = $professionRepo;
    }


    public function create()
    {
        return view('admin/createProfession');
    }
    public function store(ProfessionCreateRequest $request)
    {
        $profession = $request->only('profession');
        $profession['name']=$profession['profession'];
        $this->professionRepo->create($profession);
        return redirect()->route('adminCreateProfession');
    }

}
