<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\SocialProvider;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin/welcome_admin');
    }


    public function create_user()
    {
        return view('admin/create_user');
    }


    public function store(UserCreateRequest $request)
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

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin/user')->with(['user'=>$user]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $user_data_request = $request->all();
        $user_data_update =User::findOrFail($id);

        if ($request->only('name','email')){
            $user_data_request = $request->only('name','email');
            $user_data_update->update($user_data_request);

            return redirect()->route('admin_user', [$id]);
        }

        if($user_data_request['password'] == null){
            $user_data_request = $request->only('name','email');
            $user_data_update ->update($user_data_request);

            return redirect()->route('admin_user', [$id]);
        }
        $user_data_update->update($user_data_request);

        return redirect()->route('admin_user', [$id]);
    }


    public function destroy($id)
    {
       User::findOrFail($id)->delete();

       return redirect()->route('admin_users');
    }
}
