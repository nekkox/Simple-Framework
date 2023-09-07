<?php

namespace Classes;
use Exception;

class RouteNotFoundException extends Exception
{

    protected $message = 'Route not found';
}