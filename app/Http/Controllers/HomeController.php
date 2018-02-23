<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
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
        };

       $user = Auth::user();
       return view('user/home')->with(['user'=> $user]);
    }
    public function update(UserUpdateRequest $request, $id)
    {
        $user_data_request = $request->all();
        $user_data_update =User::findOrFail($id);

        if ($request->only('name','email')){
            $user_data_request = $request->only('name','email');
            $user_data_update->update($user_data_request);

            return redirect()->route('home');
        }

        if($user_data_request['password'] == null){
            $user_data_request = $request->only('name','email');
            $user_data_update ->update($user_data_request);

            return redirect()->route('home');
        }
        $user_data_update->update($user_data_request);
        return redirect()->route('home');
    }


    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('welcome');
    }


}
