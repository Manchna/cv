<?php

namespace App\Repositories\User\Profession;

use App\Profession;

class ProfessionRepository  implements ProfessionInterface
{
    private $profession;

    function __construct(Profession $profession) {
        $this->profession = $profession;
    }

    public function getAll(){
        return $this->profession->getAllProfession();
    }
    public function find($id){
        return $this->profession->findProfession($id);
    }
}