<?php
namespace App\Repositories\Admin\User;

interface UserInterface {

    public function create($data);

    public function select($data);

    public function find($id);

    public function update(array $data, $id);

    public function delete($id);

    public function whereForCharts($data);


}