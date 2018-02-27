<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
            ->get();
        $chart = Charts::database($users, 'bar', 'highcharts')
            ->title("Monthly new Register Users")
            ->elementLabel("Total Users")
            ->dimensions(1000, 500)
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
        return view('admin/user')->with(['user'=>$user]);
    }

    public function updateUser(UserUpdateRequest $request, $id)
    {
        $adminUserDataRequest = $request->all();
        $adminUserDataUpdate =User::findOrFail($id);
        if($adminUserDataRequest == $request->only('name','email')){
            $adminUserDataUpdate->update($adminUserDataRequest);
            return redirect()->route('home');
        }
        if($adminUserDataRequest['password'] == null){
            $adminUserDataRequest = $request->only('name','email');
            $adminUserDataUpdate ->update($adminUserDataRequest);
            return redirect()->route('home');
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
}
