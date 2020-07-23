<?php

namespace App\Repositories;

use App\DTO\BaseDTO;

interface RepositoryInterface {

    public function getList();

    public function create(BaseDTO $dto);

    public function update();

    public function delete();

}
