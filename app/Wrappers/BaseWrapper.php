<?php

namespace App\Wrappers;

abstract class BaseWrapper {
    protected $entity;

    public function __construct($entity) {
        $this->entity = $entity;
    }

    public function getEntity() {
        return $this->entity;
    }
}
