<?php

namespace App\Repositories;

interface RepositoryInterface {

    public function getList();

    public function create(array $params);

    public function update();

    public function delete(int $id);

}
