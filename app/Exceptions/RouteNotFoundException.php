<?php

namespace app\Exceptions;
use Exception;

class RouteNotFoundException extends Exception
{

    protected $message = 'Route not found';
}