<?php

namespace App;

/**
 * @property-read ?array $db
 */
class Config
{
    protected $config = [];

    /**
     * @param array $_ENV
     */
    public function __construct(array $env)
    {
        $this->config = [
            'db' =>
            [
                'host'  => $env['DB_HOST'],
                'user'  => $env['DB_USER'],
                'pass'  => $env['DB_PASS'],
                'database'  => $env['DB_DATABASE'],
                'driver'  => $env['DB_DRIVER'] ?? 'mysql',
            ],
        ];
    }

    public function __get($name){
        return $this->config[$name] ?? null;
    }
}