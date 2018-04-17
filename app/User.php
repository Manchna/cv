<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function CreateUser($data)
    {
        return static::create($data);
    }

     public function selectUser($data)
    {
        return static::select($data)->get();
    }

     public function findOrFailUser($id)
    {
        return static::findOrFail($id);
    }

    public function updateUser(array $data, $id)
    {
        return static::find($id)->update($data);
    }

    public function deleteUser($id)
    {
        return static::find($id)->delete();
    }
   public function whereForChartsUser($data)
    {
        return static::where($data,date('Y'))->get();
    }



    public function isAdmin()
    {
        if ($this->role==1){
            return true;
        }
        else{
            return false;
        }
    }

    function socialProviders(){
        return $this->hasMany('App\SocialProvider');
    }
    function answer(){
        return $this->hasMany('App\Answer');
    }

}
