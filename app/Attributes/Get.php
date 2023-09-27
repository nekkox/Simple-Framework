<?php

namespace App\Attributes;

use App\Enums\HttpMethod;
use Attribute;

#[Attribute]
class Get extends Route
{
    public function __construct(string $route)
    {
        parent::__construct($route, HttpMethod::Get);
    }

}