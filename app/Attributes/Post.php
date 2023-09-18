<?php

namespace App\Attributes;

use App\Enums\HttpMethod;
use Attribute;

#[Attribute]
class Post extends Route
{
    public function __construct(string $route)
    {
        parent::__construct($route, HttpMethod::Post);
        var_dump(HttpMethod::Post);
    }

}