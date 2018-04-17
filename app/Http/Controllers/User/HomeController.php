<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Repositories\User\UserInterface as UserInterface;
use App\Repositories\User\Answer\AnswerInterface as AnswerInterface ;
use App\Repositories\User\Profession\ProfessionInterface as ProfessionInterface ;

class HomeController extends Controller
{
    private $userRepo;
    private $answerRepo;
    private $professionRepo;


    public function __construct(UserInterface $userRepo, AnswerInterface $answerRepo, ProfessionInterface $professionRepo)
    {
        $this->userRepo = $userRepo;
        $this->answerRepo = $answerRepo;
        $this->professionRepo = $professionRepo;
    }

    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin');
        }
        $data['answers'] = $this->answerRepo->getone(Auth::user()->id);
        $data['user'] = Auth::user();
        $data['name'] = $this->professionRepo->getAll();

        return view('user/home')->with(['data' => $data]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->all();
        if ($data == $request->only('name', 'email', '_token')) {
            $this->userRepo->update( $data, $id);
            return redirect()->route('home');
        }
        if ($data['password'] == null) {
            $data = $request->only('name', 'email');
            $this->userRepo->update($data, $id);
            return redirect()->route('home');
        }
        $data['password'] = bcrypt($request['password']);
        $this->userRepo->update($data, $id);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        $this->userRepo->delete($id);
        return redirect()->route('welcome');
    }

    public function pdfView($id ,$download)
    {
        $answers = $this->answerRepo->getone($id);


        $answerText = '';
        foreach ($answers as $key => $answer) {
            $profession = $answer->question->profession;
            $answerText .= '<br />'.$answer->question->text.'<br />'.$answer->text;
            $userName = $answer->user->name;
            $userEmail = $answer->user->email;
        }

        $pdf = PDF::loadHTML(
        '<h1 style="margin-left:30%; font-size:55px;  font-family:Arial ">'.strtoupper($profession[0]->name).'</h1>'.
        '<p style="font-size:30px; ">'.'name '.ucfirst($userName) .'<br />'.'email '.$userEmail.'</p>'.
        '<p>'.$answerText.'</p>');
        if ($download==1){
            return $pdf->download('myCv.pdf');
        }
        return $pdf->stream();
    }
}

