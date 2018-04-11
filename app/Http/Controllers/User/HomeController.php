<?php

namespace App\Http\Controllers\User;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Profession;
use App\User;
use Illuminate\Support\Facades\Auth;

use PDF;

class HomeController extends Controller
{

    public function index()
    {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin');
        }
        $userId = Auth::user()->id;
        $answers = Answer::where('user_id', $userId)->get();
        $data['answers'] = $answers;
        $data['user'] = Auth::user();
        $data['name'] = Profession::get();

        return view('user/home')->with(['data' => $data]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $userDataRequest = $request->all();
        $userDataUpdate = User::findOrFail($id);
        if ($userDataRequest == $request->only('name', 'email', '_token')) {
            $userDataUpdate->update($userDataRequest);
            return redirect()->route('home');
        }
        if ($userDataRequest['password'] == null) {
            $userDataRequest = $request->only('name', 'email');
            $userDataUpdate->update($userDataRequest);
            return redirect()->route('home');
        }
        $userDataRequest['password'] = bcrypt($request['password']);
        $userDataUpdate->update($userDataRequest);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('welcome');
    }

    public function pdfView($id ,$download)
    {
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

