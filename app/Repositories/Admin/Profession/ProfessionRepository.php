<?php

namespace App\Repositories\Admin\Profession;

use App\Profession;
class ProfessionRepository implements ProfessionInterface
{
    private $profession;

    function __construct(Profession $profession) {
        $this->profession = $profession;
    }
    public function getAll()
    {
        return $this->profession->getAllProfession();
    }
    public function select($id)
    {
        return $this->profession->selectprofession($id);
    }
    public function create($data)
    {
        return $this->profession->createProfession($data);
    }
}