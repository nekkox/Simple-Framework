<?php

namespace App\Attributes;

use App\Contracts\RouteInterface;
use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route implements RouteInterface
{
    public function __construct(public string $route, public string $method = 'get')
    {
    }

}