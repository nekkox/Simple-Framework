<?php

namespace App\Exceptions;
use Exception;

class RouteNotFoundException extends Exception
{

    protected $message = 'Route not found';
    protected $message404 = "404 Page not found";

    public function redirect(){
        echo $this->message404;
        header('Location: /router/',false,404);
    }
}