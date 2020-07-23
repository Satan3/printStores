<?php

namespace App\Builders;

use App\DTO\BaseDTO;

abstract class BaseBuilder {
    private $dtoFields = [];
    private $dtoClass = null;

    public function buildDTO(array $rawParams): BaseDTO {
        $params = [];
        foreach ($this->dtoFields as $field) {
            $params[] = $rawParams[$field];
        }
        $params[] = $rawParams['name'];
        return new $this->dtoClass($params);
    }
}
