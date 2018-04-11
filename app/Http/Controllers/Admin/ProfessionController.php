<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfessionCreateRequest;
use App\Profession;


class ProfessionController extends Controller
{

    public function create()
    {
        return view('admin/createProfession');
    }
    public function store(ProfessionCreateRequest $request)
    {
        $profession = $request->only('profession');
        $profession['name']=$profession['profession'];
        Profession::create($profession);
        return redirect()->route('adminCreateProfession');
    }

}
