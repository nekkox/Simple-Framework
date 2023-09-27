<?php

namespace App;

/**
 * @property-read ?array $db
 * @property-read ?array $mailer
 *
 */


class Config
{

    public array $config = [];

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
            'mailer' => [
                'dsn' => $env['MAILER_DSN'] ?? 'smtp://mailhog:1025',
            ]
        ];
    }

    public function __get($name){
        return $this->config[$name] ?? null;
    }
}