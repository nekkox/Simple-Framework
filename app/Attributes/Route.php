<?php

namespace App\Attributes;

use App\Contracts\RouteInterface;
use App\Enums\HttpMethod;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route implements RouteInterface
{
    public function __construct(public string $route, public HttpMethod $method = HttpMethod::Get)
    {
    }

}