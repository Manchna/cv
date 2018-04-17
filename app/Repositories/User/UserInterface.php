<?php
namespace App\Repositories\User;

interface UserInterface {

    public function update(array $data, $id);

    public function delete($id);
}