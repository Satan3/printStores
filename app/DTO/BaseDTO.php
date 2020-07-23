<?php

namespace App\DTO;

abstract class BaseDTO {
    private $params;

    public function __construct(array $params) {
        $this->params = $params;
    }

    public function get(string $key) {
        return $this->params[$key] ?? null;
    }

}
