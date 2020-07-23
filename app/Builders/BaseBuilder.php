<?php

namespace App\Builders;

use App\DTO\BaseDTO;

abstract class BaseBuilder {
    protected $dtoFields = [];
    protected $dtoClass = null;

    public function buildDTO(array $rawParams): BaseDTO {
        $params = [];
        foreach ($this->dtoFields as $field) {
            $params[$field] = $rawParams[$field];
        }
        return new $this->dtoClass($params);
    }
}
