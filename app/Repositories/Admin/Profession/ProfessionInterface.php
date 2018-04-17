<?php
namespace App\Repositories\Admin\Profession;

interface ProfessionInterface {

    public function getAll();

    public function select($id);

    public function create($data);
}