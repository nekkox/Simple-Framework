<?php

namespace App\Attributes;

use Attribute;

#[Attribute]
class Post extends Route
{
    public function __construct(string $route, string $method = 'post')
    {
        parent::__construct($route, $method);
    }

}