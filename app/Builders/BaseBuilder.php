<?php

namespace App\Builders;

use App\DTO\BaseDTO;

abstract class BaseBuilder {
    abstract function buildDTO(array $params): BaseDTO;
}
