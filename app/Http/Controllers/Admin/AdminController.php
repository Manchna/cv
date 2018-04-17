<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Admin\Answer\AnswerInterface as AnswerInterface;
use App\Repositories\Admin\Question\QuestionInterface as QuestionInterface;
use App\Repositories\Admin\User\UserInterface as UserInterface;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    private $userRepo;
    private $answerRepo;
    private $questionRepo;

    public function __construct(UserInterface $userRepo, AnswerInterface $answerRepo, QuestionInterface $questionRepo)
    {
        $this->userRepo = $userRepo;
        $this->answerRepo = $answerRepo;
        $this->questionRepo = $questionRepo;
    }

    public function index()
    {
        $data = DB::raw("(DATE_FORMAT(created_at,'%Y'))");
        $chart = Charts::database($this->userRepo->whereForCharts($data), 'bar', 'highcharts')
            ->title("Monthly new Register Users")
            ->elementLabel("Total Users")
            ->dimensions(500, 250)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);
        return view('admin/welcomeAdmin',compact('chart'));
    }

    public function createUser()
    {
        return view('admin/createUser');
    }

    public function storeUser(UserCreateRequest $request)
    {
        $user = $request->all();
        $user['password'] = bcrypt($request['password']);
        $this->userRepo->create($user);
        return redirect()->route('admin');
    }

    public function users()
    {
        $data['id'] = 'id';
        $data['name'] = 'name';
        $data['email'] = 'email';

        $users = $this->userRepo->select($data);
        return view('admin/users')->with(['users'=>$users]);
    }

    public function showUser($id)
    {
        $data['user'] = $this->userRepo->find($id);
        $data['answers']=$this->answerRepo->getOne($id);
        $data['questions'] = $this->questionRepo->get();

        return view('admin/user')->with(['data'=>$data]);
    }

    public function updateUser(UserUpdateRequest $request, $id)
    {
        $data = $request->all();
        if ($data == $request->only('name', 'email', '_token')) {
            $this->userRepo->update( $data, $id);
            return redirect()->route('adminUser', [$id]);
        }
        if ($data['password'] == null) {
            $data = $request->only('name', 'email');
            $this->userRepo->update($data, $id);
            return redirect()->route('adminUser', [$id]);
        }
        $data['password'] = bcrypt($request['password']);
        $this->userRepo->update($data, $id);
        return redirect()->route('adminUser', [$id]);
    }

    public function destroyUser($id)
    {
        $this->userRepo->delete($id);
       return redirect()->route('adminUsers');
    }

    public function pdfView($id , $download){

        $answers = $this->answerRepo->getOne($id);
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
