<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class Put extends Route
{
    public function __construct(string $route)
    {
        parent::__construct($route, 'put');
    }

}