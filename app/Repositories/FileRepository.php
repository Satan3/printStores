<?php

namespace App\Repositories;

use App\Entities\File;
use Doctrine\ORM\EntityRepository;

class FileRepository extends EntityRepository implements RepositoryInterface {

    public function getList() {
        // TODO: Implement getList() method.
    }

    public function create(array $params) {
        $file = new File();
        $file->setPath($params['path']);
        $this->_em->persist($file);
        $this->_em->flush();
        return $file;
    }

    public function update() {
        // TODO: Implement update() method.
    }

    public function delete(int $id) {
        // TODO: Implement delete() method.
    }
}
