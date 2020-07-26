<?php

namespace App\Repositories;

use App\DTO\BaseDTO;

interface RepositoryInterface {

    public function getList();

    public function create(array $params);

    public function update();

    public function delete();

}
