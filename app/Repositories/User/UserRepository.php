<?php

namespace App\Repositories\User;


use App\User;

class UserRepository implements UserInterface
{
    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

    public function update(array $data,$id)
    {
        return $this->user->updateUser($data, $id);
    }

    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }
}