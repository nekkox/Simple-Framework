<?php

namespace App\Xml;


Interface ILogger
{
    public function log(string $request, int $priority);
    public const PRIORITY_ERROR = 1;
    public const PRIORITY_INFO = 2;
    public const PRIORITY_WARNING = 3;
}