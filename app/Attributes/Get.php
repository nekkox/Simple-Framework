<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class Get extends Route
{
    public function __construct(string $route)
    {
        parent::__construct($route, 'get');
    }

}