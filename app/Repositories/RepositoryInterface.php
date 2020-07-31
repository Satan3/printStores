<?php

namespace App\Repositories;

interface RepositoryInterface {

    public function getList();

    public function create(array $params);

    public function update(array $params);

    public function delete(int $id);

}
