<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->isAdmin()){
            return redirect()->route('admin');
        }
       $user = Auth::user();
       return view('user/home')->with(['user'=> $user]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $userDataRequest = $request->all();
        $userDataUpdate =User::findOrFail($id);
        if($userDataRequest == $request->only('name','email')){
            $userDataUpdate->update($userDataRequest);
            return redirect()->route('home');
        }
        if($userDataRequest['password'] == null){
            $userDataRequest = $request->only('name','email');
            $userDataUpdate ->update($userDataRequest);
            return redirect()->route('home');
        }
        $userDataRequest['password']  = bcrypt($request['password']);
        $userDataUpdate->update($userDataRequest);
        return redirect()->route('home');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('welcome');
    }
}
