<?php

namespace App\Builders;

use App\DTO\CategoryDTO;

class CategoryBuilder extends BaseBuilder {
    protected $dtoFields = [
        'name'
    ];
    protected $dtoClass = CategoryDTO::class;
}
