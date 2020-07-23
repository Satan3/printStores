<?php

namespace App\Builders;

use App\DTO\CategoryDTO;

class CategoryBuilder extends BaseBuilder {
    private $dtoFields = [
        'name'
    ];
    private $dtoClass = CategoryDTO::class;
}
