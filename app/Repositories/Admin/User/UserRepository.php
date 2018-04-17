<?php

namespace App\Repositories\Admin\User;


use App\User;

class UserRepository implements UserInterface
{
    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

    public function create($data)
    {
        return $this->user->createUser($data);
    }

    public function select($data)
    {
        return $this->user->selectUser($data);
    }

    public function find($id)
    {
        return $this->user->findOrFailUser($id);
    }


    public function update(array $data,$id)
    {
        return $this->user->updateUser($data, $id);
    }

    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }

    public function whereForCharts($data){

        return $this->user->whereForChartsUser($data);
    }
}