<?php

namespace app\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'View not found';

}