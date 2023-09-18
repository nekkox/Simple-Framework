<?php

namespace App\Enums;

Enum HttpMethod:string
{
    case Get = 'get';
    case Post = 'post';
    case Delete = 'delete';
    case Put = 'put';

}