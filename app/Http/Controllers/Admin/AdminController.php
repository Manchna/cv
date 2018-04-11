<?php

namespace App\Http\Controllers\Admin;



use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Question;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
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
        User::create($user);
        return redirect()->route('admin');
    }

    public function users()
    {
        $users =User::select('id','name','email')->get();
        return view('admin/users')->with(['users'=>$users]);
    }

    public function showUser($id)
    {
        $user = User::findOrFail($id);
        $data['user' ]= $user;
        $userAnswers = Answer::where('user_id', $id)->get();
        $data['answers']=$userAnswers;
        $data['questions'] = Question::get();

        return view('admin/user')->with(['data'=>$data]);
    }

    public function updateUser(UserUpdateRequest $request, $id)
    {
        $adminUserDataRequest = $request->all();
        $adminUserDataUpdate =User::findOrFail($id);
        if($adminUserDataRequest === $request->only('name', 'email', '_token')){
            $adminUserDataUpdate->update($adminUserDataRequest);
            return redirect()->route('adminUser', [$id]);
        }
        if($adminUserDataRequest['password'] == ""){
            $adminUserDataRequest = $request->only('name','email');
            $adminUserDataUpdate ->update($adminUserDataRequest);
            return redirect()->route('adminUser', [$id]);
        }
        $adminUserDataRequest['password'] = bcrypt($request['password']);
        $adminUserDataUpdate->update($adminUserDataRequest);
        return redirect()->route('adminUser', [$id]);
    }

    public function destroyUser($id)
    {
       User::findOrFail($id)->delete();
       return redirect()->route('adminUsers');
    }

    public function pdfView($id , $download){
        $answers = Answer::where('user_id', $id)->get();

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
